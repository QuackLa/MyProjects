@extends('layouts.app')

@section('content')
<div class="register">

    <form method="POST" action="{{ route('register') }}">
    @csrf

        <label for="login"> {{ __('Login') }} </label>
        <div>
            <input id="login" type="text" name="login" value="{{ old('login') }}" placeholder="{{ __('Login') }}" required autocomplete="login">
            @error('login')
                <span role="alert">
                    <strong> {{ $message }} </strong>
                </span>
            @enderror
        </div>

        <label for="password"> {{ __('Password') }} </label>
        <div>
            <input id="password" type="password" name="password" placeholder="{{ __('Password') }}">
            @error('password')
                <span role="alert">
                    <strong> {{ $message }} </strong>
                </span>
            @enderror
        </div>

        <label for="password-confirm"> {{ __('Confirm password') }} </label>
        <div>
            <input id="password-confirm" type="password" name="password_confirmation" placeholder="{{ __('Confirm Password') }}">
        </div>

        <label for="name"> {{ __('Name') }} </label>
        <div>
            <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('Name') }}" required autocomplete="name">
            @error('name')
                <span role="alert">
                    <strong> {{ $message }} </strong>
                </span>
            @enderror
        </div>

        <label for="surname"> {{ __('Surname') }} </label>
        <div>
            <input id="surname" type="text" name="surname" value="{{ old('surname') }}" placeholder="{{ __('Surname') }}" required autocomplete="surname">
            @error('surname')
                <span role="alert">
                    <strong> {{ $message }} </strong>
                </span>
            @enderror
        </div>

        <label for="email"> {{ __('Email') }} </label>
        <div>
            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required autocomplete="email">
            @error('email')
                <span role="alert">
                    <strong> {{ $message }} </strong>
                </span>
            @enderror
        </div>

        <label for="city"> {{ __('City') }} </label>
        <div>
            <input id="city" type="text" name="city" value="{{ old('city') }}" placeholder="{{ __('City') }}" required autocomplete="city">
            @error('city')
                <span role="alert">
                    <strong> {{ $message }} </strong>
                </span>
            @enderror
        </div>

        <label for="district"> {{ __('District') }} </label>
        <div>
            <input id="district" type="text" name="district" value="{{ old('district') }}" placeholder="{{ __('District') }}" required autocomplete="district">
            @error('district')
                <span role="alert">
                    <strong> {{ $message }} </strong>
                </span>
            @enderror
        </div>
                        
        <div>
            <button class="buttonRegister" type="submit"> {{ __('Register') }} </button>
        </div>

    </form>
    
        <div>
            <a href="{{ route('login') }}"><button class='buttonLogin'> {{ __('Back to login') }} </button></a>
        </div>

</div>
@endsection