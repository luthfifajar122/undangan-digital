<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Guest;
use App\Models\Invitation;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InvitationController extends Controller
{
    public function index()
    {
        $invitations = Invitation::with('template')->latest()->paginate(15);

        return view('admin.invitations.index', compact('invitations'));
    }

    public function create()
    {
        $templates = Template::where('is_active', true)->get();

        return view('admin.invitations.create', compact('templates'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateInvitation($request);

        $invitation = Invitation::create($validated);

        // Create default event if provided
        if ($request->filled('events')) {
            foreach ($request->events as $index => $eventData) {
                if (! empty($eventData['name'])) {
                    Event::create([
                        'invitation_id' => $invitation->id,
                        'name' => $eventData['name'],
                        'date' => $eventData['date'] ?? $invitation->event_date,
                        'time' => $eventData['time'] ?? $invitation->event_time,
                        'venue_name' => $eventData['venue_name'] ?? $invitation->venue_name,
                        'address' => $eventData['address'] ?? $invitation->address,
                        'maps_link' => $eventData['maps_link'] ?? null,
                        'maps_embed' => $eventData['maps_embed'] ?? null,
                        'sort_order' => $index + 1,
                    ]);
                }
            }
        }

        return redirect()->route('admin.invitations.edit', $invitation)
            ->with('success', 'Undangan berhasil dibuat. Silakan lengkapi detail lainnya.');
    }

    public function edit(Invitation $invitation)
    {
        $templates = Template::where('is_active', true)->get();
        $invitation->load(['events', 'guests', 'galleryItems', 'wishes']);

        return view('admin.invitations.edit', compact('invitation', 'templates'));
    }

    public function update(Request $request, Invitation $invitation)
    {
        $validated = $this->validateInvitation($request, $invitation->id);

        // Handle music file upload
        if ($request->hasFile('music_file')) {
            $request->validate([
                'music_file' => 'file|mimes:mp3,ogg|max:10240',
            ]);
            // Delete old music
            if ($invitation->music_path) {
                Storage::disk('public')->delete($invitation->music_path);
            }
            $validated['music_path'] = $request->file('music_file')->store('music', 'public');
        }

        // Handle background image upload
        if ($request->hasFile('background_image')) {
            $request->validate([
                'background_image' => 'image|max:5120',
            ]);
            if ($invitation->background_image) {
                Storage::disk('public')->delete($invitation->background_image);
            }
            $validated['background_image'] = $request->file('background_image')->store('invitations/backgrounds', 'public');
        }

        $invitation->update($validated);

        // Update events
        if ($request->has('events')) {
            $invitation->events()->delete();
            foreach ($request->events as $index => $eventData) {
                if (! empty($eventData['name'])) {
                    Event::create([
                        'invitation_id' => $invitation->id,
                        'name' => $eventData['name'],
                        'date' => $eventData['date'] ?? $invitation->event_date,
                        'time' => $eventData['time'] ?? $invitation->event_time,
                        'venue_name' => $eventData['venue_name'] ?? $invitation->venue_name,
                        'address' => $eventData['address'] ?? $invitation->address,
                        'maps_link' => $eventData['maps_link'] ?? null,
                        'maps_embed' => $eventData['maps_embed'] ?? null,
                        'sort_order' => $index + 1,
                    ]);
                }
            }
        }

        return redirect()->route('admin.invitations.edit', $invitation)
            ->with('success', 'Undangan berhasil diperbarui.');
    }

    public function destroy(Invitation $invitation)
    {
        // Delete related files
        if ($invitation->music_path) {
            Storage::disk('public')->delete($invitation->music_path);
        }
        if ($invitation->background_image) {
            Storage::disk('public')->delete($invitation->background_image);
        }
        foreach ($invitation->galleryItems as $item) {
            Storage::disk('public')->delete($item->path);
        }

        $invitation->delete();

        return redirect()->route('admin.invitations.index')
            ->with('success', 'Undangan berhasil dihapus.');
    }

    public function preview(Request $request, ?Invitation $invitation = null)
    {
        // Preview with unsaved form data
        if ($request->isMethod('post')) {
            // Build invitation from form data
            $data = $request->all();
            $template = Template::findOrFail($data['template_id'] ?? $invitation?->template_id);

            $previewInvitation = new Invitation($data);
            $previewInvitation->id = $invitation?->id ?? 0;
            $previewInvitation->template_id = $template->id;
            $previewInvitation->setRelation('template', $template);
            $previewInvitation->setRelation('events', collect());

            if (! empty($data['events'])) {
                $events = collect();
                foreach ($data['events'] as $index => $eventData) {
                    if (! empty($eventData['name'])) {
                        $events->push(new Event(array_merge($eventData, [
                            'invitation_id' => 0,
                            'sort_order' => $index + 1,
                        ])));
                    }
                }
                $previewInvitation->setRelation('events', $events);
            }

            $previewInvitation->setRelation('galleryItems', collect());
            $previewInvitation->setRelation('wishes', collect());

            $config = array_merge(
                $template->config_json ?? [],
                $previewInvitation->settings_json ?? []
            );

            $view = $template->blade_path ?: 'templates.default.layout';

            return view($view, [
                'invitation' => $previewInvitation,
                'guest' => null,
                'config' => $config,
                'isPreview' => true,
            ]);
        }

        // GET preview for saved invitation
        $invitation->load(['events', 'galleryItems', 'wishes']);
        $template = $invitation->template;
        $config = array_merge(
            $template->config_json ?? [],
            $invitation->settings_json ?? []
        );

        $view = $template->blade_path ?: 'templates.default.layout';

        return view($view, [
            'invitation' => $invitation,
            'guest' => null,
            'config' => $config,
            'isPreview' => true,
        ]);
    }

    public function importGuests(Request $request, Invitation $invitation)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');
        $handle = fopen($file->getRealPath(), 'r');

        if (! $handle) {
            return back()->with('error', 'Gagal membaca file CSV.');
        }

        $headers = fgetcsv($handle);
        $requiredHeaders = ['name', 'category', 'phone'];

        if (array_diff($requiredHeaders, $headers)) {
            fclose($handle);

            return back()->with('error', 'Header CSV tidak valid. Harus: name,category,phone');
        }

        $headerMap = array_flip($headers);
        $success = 0;
        $skipped = 0;
        $errors = [];

        $rowNum = 1;
        while (($row = fgetcsv($handle)) !== false) {
            $rowNum++;
            $data = [
                'name' => trim($row[$headerMap['name']] ?? ''),
                'category' => trim($row[$headerMap['category']] ?? ''),
                'phone' => trim($row[$headerMap['phone']] ?? ''),
            ];

            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'category' => 'required|string|max:100',
                'phone' => 'required|string|max:20|regex:/^[\d\+\-\s\(\)]+$/',
            ]);

            if ($validator->fails()) {
                $skipped++;
                $errors[] = "Baris {$rowNum}: ".$validator->errors()->first();

                continue;
            }

            Guest::create([
                'invitation_id' => $invitation->id,
                'name' => $data['name'],
                'category' => $data['category'],
                'phone' => $data['phone'],
                'token' => Guest::generateToken(),
            ]);
            $success++;
        }

        fclose($handle);

        $message = "Import selesai: {$success} tamu berhasil ditambahkan.";
        if ($skipped > 0) {
            $message .= " {$skipped} baris dilewati.";
        }

        return back()->with('success', $message)->with('import_errors', $errors);
    }

    public function exportGuests(Invitation $invitation)
    {
        $guests = $invitation->guests()->with('rsvp')->get();

        $filename = "tamu-{$invitation->slug}.csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($guests) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['name', 'category', 'phone', 'token', 'rsvp_status', 'guest_count']);
            foreach ($guests as $guest) {
                fputcsv($handle, [
                    $guest->name,
                    $guest->category,
                    $guest->phone,
                    $guest->token,
                    $guest->rsvp?->status ?? 'belum',
                    $guest->rsvp?->guest_count ?? 0,
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function validateInvitation(Request $request, $id = null)
    {
        $slugRule = 'required|string|max:100|alpha_dash|unique:invitations,slug';
        if ($id) {
            $slugRule .= ','.$id;
        }

        return $request->validate([
            'template_id' => 'required|exists:templates,id',
            'slug' => $slugRule,
            'bride_name' => 'required|string|max:255',
            'groom_name' => 'required|string|max:255',
            'bride_parents' => 'nullable|string|max:500',
            'groom_parents' => 'nullable|string|max:500',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'address' => 'required|string',
            'venue_name' => 'required|string|max:255',
            'maps_link' => 'nullable|string|max:500',
            'maps_embed' => 'nullable|string',
            'story' => 'nullable|string',
            'whatsapp_number' => 'nullable|string|max:20',
            'expires_at' => 'nullable|date',
            'settings_json' => 'nullable|json',
            'status' => 'required|in:draft,published,archived',
        ]);
    }
}
