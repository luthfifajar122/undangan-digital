<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Rsvp;
use Illuminate\Http\Request;

class RsvpController extends Controller
{
    public function index(Request $request)
    {
        $query = Rsvp::with(['guest.invitation']);

        if ($request->filled('invitation_id')) {
            $query->whereHas('guest', function ($q) use ($request) {
                $q->where('invitation_id', $request->invitation_id);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $rsvps = $query->latest()->paginate(20);
        $invitations = Invitation::select('id', 'bride_name', 'groom_name', 'slug')->get();

        // Stats
        $stats = [
            'total' => Rsvp::count(),
            'hadir' => Rsvp::where('status', 'hadir')->count(),
            'tidak_hadir' => Rsvp::where('status', 'tidak_hadir')->count(),
            'total_guests' => Rsvp::where('status', 'hadir')->sum('guest_count'),
        ];

        return view('admin.rsvps.index', compact('rsvps', 'invitations', 'stats'));
    }
}
