<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Wish;
use Illuminate\Http\Request;

class WishController extends Controller
{
    public function store(Request $request, $slug)
    {
        $invitation = Invitation::where('slug', $slug)->firstOrFail();

        if ($invitation->isExpired()) {
            return response()->json(['success' => false, 'message' => 'Undangan sudah kadaluarsa.'], 410);
        }

        $validated = $request->validate([
            'guest_name' => 'required|string|max:100',
            'message' => 'required|string|max:1000',
        ]);

        $wish = Wish::create([
            'invitation_id' => $invitation->id,
            'guest_name' => $validated['guest_name'],
            'message' => $validated['message'],
            'is_approved' => false,
            'is_public' => true,
            'submitted_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ucapan berhasil dikirim. Menunggu persetujuan admin.',
        ]);
    }
}
