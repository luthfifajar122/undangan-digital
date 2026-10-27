<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Wish;
use Illuminate\Http\Request;

class WishController extends Controller
{
    public function index(Invitation $invitation)
    {
        $wishes = $invitation->wishes()->latest()->paginate(20);

        return view('admin.wishes.index', compact('invitation', 'wishes'));
    }

    public function update(Request $request, Wish $wish)
    {
        $validated = $request->validate([
            'is_approved' => 'boolean',
            'is_public' => 'boolean',
        ]);

        $wish->update($validated);

        return response()->json(['success' => true, 'wish' => $wish]);
    }

    public function destroy(Wish $wish)
    {
        $wish->delete();

        return back()->with('success', 'Ucapan berhasil dihapus.');
    }
}
