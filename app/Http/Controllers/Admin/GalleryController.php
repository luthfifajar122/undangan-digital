<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function store(Request $request, Invitation $invitation)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480',
            'caption' => 'nullable|string|max:255',
        ]);

        $file = $request->file('file');
        $mime = $file->getMimeType();
        $type = str_starts_with($mime, 'video/') ? 'video' : 'image';

        $path = $file->store("gallery/{$invitation->id}", 'public');

        $item = GalleryItem::create([
            'invitation_id' => $invitation->id,
            'type' => $type,
            'path' => $path,
            'caption' => $request->caption,
            'sort_order' => $invitation->galleryItems()->max('sort_order') + 1,
        ]);

        return response()->json([
            'success' => true,
            'item' => [
                'id' => $item->id,
                'type' => $item->type,
                'url' => $item->url,
                'caption' => $item->caption,
            ],
        ]);
    }

    public function update(Request $request, GalleryItem $item)
    {
        $validated = $request->validate([
            'caption' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $item->update($validated);

        return response()->json(['success' => true]);
    }

    public function destroy(GalleryItem $item)
    {
        Storage::disk('public')->delete($item->path);
        $item->delete();

        return response()->json(['success' => true]);
    }
}
