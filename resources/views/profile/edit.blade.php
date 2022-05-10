@extends('layouts.app')

@section('content')
    <div class="container rounded mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h2>{{ __('Edit user profile') }}</h2>
                            <div class="ml-auto">
                                <a href="{{ route('user.profile.show', $user->id) }}" class="btn btn-outline-secondary">{{ __('Back to profile') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="container">
                            <form action="{{ route('user.profile.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row mt-2">
                                    <div class="form-group col-6">
                                        <label class="h5" for="name">{{ __('Name') }}</label>
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">

                                        @if ($errors->has('name'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group col-6">
                                        <label class="h5" for="email">{{ __('Email') }}</label>
                                        <input type="text" name="email" value="{{ old('email', $user->email) }}" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">

                                        @if ($errors->has('email'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="form-group col-6">
                                        <label class="h5" for="mobile_number">{{ __('Mobile Number') }}</label>
                                        <input type="text" name="mobile_number" value="{{ old('mobile_number', $user->mobile_number) }}" id="profile_name" class="form-control {{ $errors->has('mobile_number') ? 'is-invalid' : '' }}">

                                        @if ($errors->has('mobile_number'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('mobile_number') }}</strong>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group col-6">
                                        <label class="h5" for="github_link">{{ __('Github link') }}</label>
                                        <input type="text" name="github_link" value="{{ old('github_link', $user->github_link) }}" id="profile_name" class="form-control {{ $errors->has('github_link') ? 'is-invalid' : '' }}">

                                        @if ($errors->has('github_link'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('github_link') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="form-group col-6">
                                        <label class="h5" for="country">{{ __('Country') }}</label>
                                        <input type="text" name="country" value="{{ old('country', $user->country) }}" id="profile_name" class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}">

                                        @if ($errors->has('country'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('country') }}</strong>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group col-6">
                                        <label class="h5" for="city">{{ __('City') }}</label>
                                        <input type="text" name="city" value="{{ old('city', $user->city) }}" id="profile_name" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}">

                                        @if ($errors->has('city'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="form-group col-6">
                                        <label class="h5" for="address_line1">{{ __('Address line 1') }}</label>
                                        <input type="text" name="address_line1" value="{{ old('address_line1', $user->address_line1) }}" id="profile_name" class="form-control {{ $errors->has('address_line1') ? 'is-invalid' : '' }}">

                                        @if ($errors->has('address_line1'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('address_line1') }}</strong>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group col-6">
                                        <label class="h5" for="address_line2">{{ __('Address line 2') }}</label>
                                        <input type="text" name="address_line2" value="{{ old('address_line2', $user->address_line2) }}" id="profile_name" class="form-control {{ $errors->has('address_line2') ? 'is-invalid' : '' }}">

                                        @if ($errors->has('address_line2'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('address_line2') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="form-group col-6">
                                        <label class="h5" for="about">{{ __('About me') }}</label>
                                        <textarea name="about" id="about" rows="5" class="form-control {{ $errors->has('about') ? 'is-invalid' : '' }}">{{ old('about', $user->about) }}</textarea>

                                        @if ($errors->has('about'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('about') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-outline-primary btn-lg">{{ __('Save Changes') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
