@extends('layouts.app')

@section('content')
    <div class="container-login">
        <div class="wrapper">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <h1>Inicio de sesión</h1>

                <div class="input-box">
                    <label for="email">{{ __('Correo electronico') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-box">
                    <label for="password">{{ __('Contraseña') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Recordarme') }}
                    </label>
                </div>

                <button type="submit" class="login-button">
                    {{ __('Entrar') }}
                </button>

                @if (Route::has('password.request'))
                    <div class="register-link">
                        <p>
                            <a href="{{ route('password.request') }}">{{ __('Olvidates tu contraseña?') }}</a>
                        </p>
                    </div>
                @endif

                <div class="register-link">
                    <p>¿No tienes una cuenta? <a href="/register">Regístrate</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection
