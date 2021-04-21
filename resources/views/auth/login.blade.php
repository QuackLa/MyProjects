@extends('layouts.app')

@section('content')
<div class='login'>

    <form method="POST" action="{{ route('login') }}">
    @csrf

        <label for="login"> {{ __('Login') }} </label>
        <div>
            <input id="login" type="text" name="login" value="{{ old('login') }}">
            @error('login')
                <span role="alert">
                    <strong> {{ $message }} </strong>
                </span>
            @enderror
        </div>
    
        <label for="password"> {{ __('Password') }} </label>
        <div>
            <input id="password" type="password" name="password" value="">
            @error('password')
                <span role="alert">
                    <strong> {{ $message }} </strong>
                </span>
            @enderror
        </div>

        <div>
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <lable for="remember"> {{ __('Remember Me') }} </lable>
        </div>

        <div>
            <button class='buttonLogin' type="submit"> {{ __('Login') }} </button>
        </div>
        
    </form>

        <div>
            <a href="{{ route('register') }}"><button class='buttonLogin'> {{ __('Register') }} </button></a>
        </div>

</div>
@endsection