@extends('layouts.app')

@section('content')
    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">{{ __('Reset password') }}</div>
                        <div class="card-body d-flex justify-content-center">

                            @if(session('error'))
                                <div class="alert alert-danger text-center" id="invalid_token">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form class="col-8" action="{{ route('reset.password.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group row">
                                    <label for="email_address" class="col-form-label text-md-end">{{ __('E-mail address') }}</label>
                                    <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>
                                    <input type="password" id="password" class="form-control" name="password" required autofocus>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-form-label text-md-end">{{ __('Confirm password') }}</label>
                                    <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>

                                <div class="row mb-0">
                                    <div class="col-12 mb-4 mt-2 p-0">
                                        <button type="submit" class="btn btn-primary btn-block sign-button text-uppercase font-weight-bold">
                                            {{ __('Reset password') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
