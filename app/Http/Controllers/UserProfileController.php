<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UserProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('profile.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Gate::denies('update-profile', $user)) {
            abort(403, "Access denied");
        }

        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserProfileUpdateRequest $request, User $user)
    {
        if (Gate::denies('update-profile', $user)) {
            abort(403, "Access denied");
        }
        $user->update($request->all());

        return redirect()->route('user.profile.show', $user->id)->with('success',
            __('Your profile has been updated'));
    }

    public function updateAvatar(Request $request, User $user)
    {
        if (Gate::denies('update-profile', $user)) {
            abort(403, "Access denied");
        }

        $request->validate([
            'user_profile_avatar' => 'mimes:png,jpg,jpeg|image',
        ]);

        $path = '/images';
        $file = $request->file('user_profile_avatar');
        if (!isset($file)) {
            return back()->with('error', __('A new avatar must be selected'));
        }
        $new_name = 'AVATAR_'.date('Ymd').uniqid().'.jpg';

        $upload = $file->move(public_path($path), $new_name);
        if (!$upload) {
            return back()->with('error', __('Something went wrong, try again'));
        } else {
            $oldPicture = $user->getAvatarAttribute();

            if (isset($oldPicture)) {
                if (File::exists(public_path($oldPicture))) {
                    File::delete(public_path($oldPicture));
                }
            }

            $user->update([
                'avatar' => $new_name
            ]);

            return back()->with('success', __('Your profile avatar has been updated successfully'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Gate::denies('delete-profile', $user)) {
            abort(403, "Access denied");
        }
        $user->delete();

        return redirect()->route('questions.index')->with('warning', __('Your user account was deleted'));
    }
}
