<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Invitation;
use App\Models\Rsvp;
use Illuminate\Http\Request;

class RsvpController extends Controller
{
    public function store(Request $request, $slug, $token)
    {
        $invitation = Invitation::where('slug', $slug)->firstOrFail();

        if ($invitation->isExpired()) {
            return response()->json(['success' => false, 'message' => 'Undangan sudah kadaluarsa.'], 410);
        }

        $guest = Guest::where('token', $token)
            ->where('invitation_id', $invitation->id)
            ->firstOrFail();

        $validated = $request->validate([
            'status' => 'required|in:hadir,tidak_hadir',
            'guest_count' => 'required|integer|min:1',
            'message' => 'nullable|string|max:1000',
        ]);

        $rsvp = Rsvp::updateOrCreate(
            ['guest_id' => $guest->id],
            [
                'status' => $validated['status'],
                'guest_count' => $validated['guest_count'],
                'message' => $validated['message'] ?? null,
                'submitted_at' => now(),
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Konfirmasi kehadiran berhasil dikirim.',
            'rsvp' => $rsvp,
        ]);
    }
}
