@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .login-container {
        width: 100%;
        max-width: 400px;
        padding: 30px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .login-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        height: 10px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 10px;
    }

    .btn-primary {
        width: 100%;
        height: 40px;
        font-size: 16px;
    }

    .form-check-label {
        font-size: 14px;
    }

    .btn-link {
        display: block;
        text-align: center;
        margin-top: 15px;
        font-size: 14px;
    }

    .brand {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 18px;
        color: #333;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .form-group .form-control {
        width: 100%;
    }
</style>

<div class="login-container">
    <div class="brand">
        <span>Laravel</span>
    </div>

    <div class="login-header">
        <h2>{{ __('Login') }}</h2>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
            </label>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ __('Login') }}
        </button>

        @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
        @endif
    </form>
</div>
@endsection