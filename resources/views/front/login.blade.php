@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="container">
        <input type="checkbox" id="check">
        <div class="login form">
            <header>{{ __('messages.auth.enter.login') }}</header>
            @if ($errors->any())
                <script>
                    window.onload = () => {
                        showErrorAlert(`{!! implode('', $errors->all('<div>:message</div>')) !!}`);
                    };
                </script>
            @endif
            <form action="{{ route('auth.login') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="{{ __('messages.auth.enter.email') }}" required>
                <input type="password" name="password" placeholder="{{ __('messages.auth.enter.password') }}" required>
                <a href="#">{{ __('messages.auth.enter.forgot') }}</a>
                <input type="submit" class="button" value="{{ __('messages.auth.enter.login') }}">
            </form>
            <div class="signup">
        <span class="signup">{{ __('messages.auth.enter.dont_have_an_account') }}
         <label for="check">{{ __('messages.auth.enter.signup') }}</label>
        </span>
            </div>
        </div>
        <div class="registration form">
            <header>{{ __('messages.auth.enter.signup') }}</header>
            @if ($errors->any())
                <script>
                    window.onload = () => {
                        showErrorAlert(`{!! implode('', $errors->all('<div>:message</div>')) !!}`);
                    };
                </script>
            @endif
            <form action="{{ route('auth.register') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="{{ __('messages.auth.enter.email') }}" required>
                <input type="password" name="password" placeholder="{{ __('messages.auth.enter.password') }}" required>
                <input type="password" name="password_confirmation" placeholder="{{ __('messages.auth.enter.password.confirm') }}" required>
                <input type="submit" class="button" value="{{ __('messages.auth.enter.signup') }}">
            </form>
            <div class="signup">
        <span class="signup">{{ __('messages.auth.enter.already_have_an_account') }}
         <label for="check">{{ __('messages.auth.enter.login') }}</label>
        </span>
            </div>
        </div>
    </div>
@endsection
