<?php

use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\GuestController as AdminGuestController;
use App\Http\Controllers\Admin\InvitationController as AdminInvitationController;
use App\Http\Controllers\Admin\RsvpController as AdminRsvpController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\WishController as AdminWishController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\RsvpController;
use App\Http\Controllers\WishController;
use Illuminate\Support\Facades\Route;

// Landing page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.invitations.index'));

    // Templates
    Route::resource('templates', TemplateController::class)->except(['show']);

    // Invitations
    Route::resource('invitations', AdminInvitationController::class)->except(['show']);
    Route::post('invitations/{invitation}/guests/import', [AdminInvitationController::class, 'importGuests'])->name('invitations.guests.import');
    Route::get('invitations/{invitation}/guests/export', [AdminInvitationController::class, 'exportGuests'])->name('invitations.guests.export');
    Route::post('invitations/preview', [AdminInvitationController::class, 'preview'])->name('invitations.preview');
    Route::get('invitations/{invitation}/preview', [AdminInvitationController::class, 'preview'])->name('invitations.preview.show');

    // Guests
    Route::delete('guests/{guest}', [AdminGuestController::class, 'destroy'])->name('guests.destroy');

    // RSVPs
    Route::get('rsvps', [AdminRsvpController::class, 'index'])->name('rsvps.index');

    // Wishes
    Route::patch('wishes/{wish}', [AdminWishController::class, 'update'])->name('wishes.update');
    Route::delete('wishes/{wish}', [AdminWishController::class, 'destroy'])->name('wishes.destroy');

    // Gallery
    Route::post('invitations/{invitation}/gallery', [AdminGalleryController::class, 'store'])->name('invitations.gallery.store');
    Route::patch('gallery/{item}', [AdminGalleryController::class, 'update'])->name('gallery.update');
    Route::delete('gallery/{item}', [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');
});

// Public invitation routes
Route::get('/{slug}', [InvitationController::class, 'show'])->name('invitation.show');
Route::get('/{slug}/rsvp/{token}', [InvitationController::class, 'showRsvp'])->name('invitation.rsvp');
Route::post('/{slug}/rsvp/{token}', [RsvpController::class, 'store'])->name('rsvp.store');
Route::post('/{slug}/wish', [WishController::class, 'store'])->name('wish.store');
