<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function show(Request $request, $slug)
    {
        $invitation = Invitation::where('slug', $slug)->firstOrFail();

        // Check expiration
        if ($invitation->isExpired()) {
            return response()->view('invitations.expired', compact('invitation'), 410);
        }

        // Check status
        if ($invitation->status !== 'published') {
            abort(404);
        }

        $invitation->load(['events', 'galleryItems', 'wishes' => function ($q) {
            $q->approved()->latest();
        }]);

        $template = $invitation->template;
        $config = array_merge(
            $template->config_json ?? [],
            $invitation->settings_json ?? []
        );

        // View tracking (cookie-based 24h)
        $cookieName = 'viewed_invitation_'.$invitation->id;
        if (! $request->cookie($cookieName)) {
            $invitation->increment('views_count');
            cookie()->queue($cookieName, true, 1440); // 24 hours
        }

        $view = $template->blade_path ?: 'templates.default.layout';

        return view($view, [
            'invitation' => $invitation,
            'guest' => null,
            'config' => $config,
            'isPreview' => false,
        ]);
    }

    public function showRsvp(Request $request, $slug, $token)
    {
        $invitation = Invitation::where('slug', $slug)->firstOrFail();

        if ($invitation->isExpired()) {
            return response()->view('invitations.expired', compact('invitation'), 410);
        }

        if ($invitation->status !== 'published') {
            abort(404);
        }

        $guest = Guest::where('token', $token)
            ->where('invitation_id', $invitation->id)
            ->firstOrFail();

        $invitation->load(['events', 'galleryItems']);

        $template = $invitation->template;
        $config = array_merge(
            $template->config_json ?? [],
            $invitation->settings_json ?? []
        );

        $view = $template->blade_path ?: 'templates.default.layout';

        return view($view, [
            'invitation' => $invitation,
            'guest' => $guest,
            'config' => $config,
            'isPreview' => false,
            'showRsvp' => true,
        ]);
    }
}
