@extends('layouts.app')

@section('content')
    <div class="container-register">
        <div class="wrapper">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h1>{{ __('Registro de usuario') }}</h1>

                <div class="input-box">
                    <input id="name" type="text" placeholder="Nombre"
                        class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                        required autocomplete="name" autofocus>
                    <FaUser class="icon" />

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-box">
                    <input id="email" type="email" placeholder="Email"
                        class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                        required autocomplete="email">
                    <TfiEmail class="icon" />

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-box">
                    <input id="password" type="password" placeholder="Contraseña"
                        class="form-control @error('password') is-invalid @enderror" name="password" required
                        autocomplete="new-password">
                    <FaLock class="icon" />

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-box">
                    <input id="password-confirm" type="password" placeholder="Confirmar Contraseña" class="form-control"
                        name="password_confirmation" required autocomplete="new-password">
                </div>

                <div>
                    <button type="submit" class="register-button" id="register-btn">
                        {{ __('Registrarse') }}
                    </button>
                </div>


                <div class="register-link">
                    <p>
                        Ya estás registrado? <a href="/login">Conectarse</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection
