@extends('layout.base')


@section('head')
    <style>
        .bg-login {
            background-image: url({{ asset('bg-login.jpg') }});
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
    <div class="w-100 h-100 bg-login d-flex flex-column justify-content-center align-items-center">

        @if(session('notif'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session("notif") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="p-4 blur flex-col rounded-3 w-100 form-container">

            <h1 class="text-white fw-bold mb-4">Login</h1>

            <form action="{{ route('doLogin') }}" method="POST">
                @csrf
                <div class="form-floating mb-4">
                    <input type="email" class="form-control" id="email">
                    <label for="email">Email address</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="password">
                    <label for="password">Password</label>
                </div>

                <div class="form-check text-white mb-4">
                    <input class="form-check-input" type="checkbox" value="" id="remember_me">
                    <label class="form-check-label" for="remember_me">
                        Remeber me
                    </label>
                </div>

                <button class="btn btn-primary w-100 " type="submit">Log In</button>

                <hr>

                <p class="text-white">Don't have an Account Yet? Click <a href="{{ route('register') }}">Here</a> to
                    register</p>

            </form>
        </div>
    </div>

    <script>
        @if (session('notif'))
            console.log("{{ session('notif') }}")
        @endif
    </script>
@endsection
