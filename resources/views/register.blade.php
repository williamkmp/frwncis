@extends('layout.base')


@section('head')
    <style>
        .bg-login {
            background-image: url({{  asset("bg-login.jpg") }});
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .blur {
            backdrop-filter: blur(8px) brightness(1.05);
        }

        .form-container {
            width: 500px;
            max-width: 500px;
        }
    </style>
@endsection


@section('content')
    <div class="w-100 h-100 bg-login d-flex justify-content-center align-items-center">

        <div class="p-4 blur flex-col rounded-3 w-100 form-container">

            <h1 class="text-white fw-bold mb-4">Register</h1>

            <form action="{{ route("doRegister") }}" method="POST">
                @csrf
                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    <label for="name">Full name</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    <label for="email">Email address</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="password" name="password">
                    <label for="password">Password</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    <label for="password">Confirm password</label>
                </div>

                <div class="form-check text-white mb-4">
                    <input class="form-check-input" type="checkbox" id="toc" name="term_and_condition">
                    <label class="form-check-label" for="toc">
                        I Agree To The Terms and Conditions
                    </label>
                </div>

                @if ($errors->any())
                    <p class="text-danger">{{ $errors->first() }}</p>
                @endif

                <button class="btn btn-primary w-100 " type="submit">Register</button>

                <hr>

                <p class="text-white">Already have an Account? Click <a href="{{ route("login") }}">Here</a> to login</p>

            </form>
        </div>
    </div>
@endsection
