<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UserProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

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

        return redirect()->route('profile.show', $user->id)->with('success',
            __('Your profile has been updated'));
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
