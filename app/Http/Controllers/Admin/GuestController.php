<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Invitation;

class GuestController extends Controller
{
    public function index(Invitation $invitation)
    {
        $guests = $invitation->guests()->with('rsvp')->latest()->paginate(20);

        return view('admin.guests.index', compact('invitation', 'guests'));
    }

    public function destroy(Guest $guest)
    {
        $guest->delete();

        return back()->with('success', 'Tamu berhasil dihapus.');
    }
}
