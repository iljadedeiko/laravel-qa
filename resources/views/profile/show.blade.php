@extends('layouts.app')

@section('content')
<div class="container emp-profile">
    <div class="row">
        <div class="col-md-4">
            <div class="profile-img">
                <img src="{{ asset($user->avatar) }}" alt=""/>
                <div class="file btn btn-lg btn-primary">
                    Change Photo
                    <input type="file" name="file"/>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="profile-head">
                <h5>{{ $user->name }}</h5>
                <h6>{{ $user->email }}</h6>
                <p class="proile-rating">RANKINGS : <span>8/10</span></p>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __('About') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{ __('More Info') }}</a>
                    </li>
                </ul>
            </div>
        </div>
{{--        @can('update-profile', $user)--}}
        @if (Auth::id() === $user->id)
            <div class="col-md-2">
                <a href="{{ route('user.profile.edit', $user->id) }}">
                    <button class="profile-edit-btn">{{ __('Edit Profile') }}</button>
                </a>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="profile-work">
                <p>{{ __('Links') }}</p>
                <a href="{{ $user->github_link }}">{{ __('Github Link') }}</a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <label>{{ __('User Id') }}</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ $user->id }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>{{ __('Full Name') }}</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ $user->name }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>{{ __('Email') }}</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>{{ __('Mobile Phone') }}</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ isset($user->mobile_number) ? $user->mobile_number : '-' }}</p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <label>{{ __('Address') }}</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ isset($user->address_line1) ? (isset($user->address_line2) ? $user->address_line1 . ', ' . $user->address_line2 : $user->address_line1) : '-' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>{{ __('City') }}</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ isset($user->city) ? $user->city : '-' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>{{ __('Country') }}</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ isset($user->country) ? $user->country : '-' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>{{ __('About') }}</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ isset($user->about) ? $user->about : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
