<?php

namespace App\Http\Controllers\Translator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display profile.
     */
    public function index()
    {
        $user = Auth::user();

        return view(
            'translator.profile.index',
            compact('user')
        );
    }

    /**
     * Show edit form.
     */
    public function edit($id)
    {
        $user = Auth::user();

        if ($user->id != $id) {
            abort(403);
        }
        $profile = $user->translatorProfile;
        return view(
            'translator.profile.edit',
            compact('profile')
        );
    }

    /**
     * Update profile.
     */
    public function update(
        Request $request,
        $id
    ) {
        $user = Auth::user();

        if ($user->id != $id) {
            abort(403);
        }

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'academic_title' => [
                'nullable',
                'string',
                'max:255'
            ],

            'university' => [
                'nullable',
                'string',
                'max:255'
            ],

            'expertise' => [
                'nullable',
                'string',
                'max:255'
            ],

            'publication_count' => [
                'nullable',
                'integer',
                'min:0'
            ],

            'hourly_rate' => [
                'nullable',
                'numeric',
                'min:0'
            ],

            'avatar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ]
        ]);

        if ($request->hasFile('avatar')) {

            if (
                $user->avatar &&
                Storage::disk('public')->exists(
                    $user->avatar
                )
            ) {
                Storage::disk('public')->delete(
                    $user->avatar
                );
            }

            $avatar = $request
                ->file('avatar')
                ->store(
                    'avatars',
                    'public'
                );

            $user->avatar = $avatar;
        }

        $user->name = $request->name;
        $user->academic_title = $request->academic_title;
        $user->university = $request->university;
        $user->expertise = $request->expertise;
        $user->publication_count = $request->publication_count;
        $user->hourly_rate = $request->hourly_rate;

        $user->save();

        return redirect()
            ->route(
                'translator.profile.index'
            )
            ->with(
                'success',
                'Profile updated successfully.'
            );
    }

    /**
     * Disable create.
     */
    public function create()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        abort(404);
    }

    public function show($id)
    {
        return redirect()->route(
            'translator.profile.index'
        );
    }

    public function destroy($id)
    {
        abort(404);
    }
}