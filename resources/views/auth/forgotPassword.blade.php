@extends('layouts.app')

@section('content')
<div class="container password-reset">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @elseif(session('message'))
                    <div class="alert alert-success text-center m-4" id="forgot_password" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="card-body d-flex justify-content-center">
                    <form class="col-8" method="POST" action="{{ route('forgot.password.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row mb-0">
                            <div class="col-12 mb-4 mt-2 p-0">
                                <button type="submit" class="btn btn-primary btn-block sign-button text-uppercase font-weight-bold">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
