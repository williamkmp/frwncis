@extends('layout.base')


@section('head')
    <style>
        .border-none {
            border: 0px solid transparent !important;
        }
    </style>
    @yield('page-head')
@endsection


@section('content')
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-light px-3">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="logo" height="40">
            </a>
            <div class="collapse navbar-collapse ms-3" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"
                            href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'showLocations' ? 'active' : '' }}"
                            href="{{ route('showLocations') }}">Our
                            Locations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'showProducts' ? 'active' : '' }}"
                            href="{{ route('showProducts') }}">Our
                            Products</a>
                    </li>
                    @if (Auth::user()->role == 'Admin')
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'showTransactions' ? 'active' : '' }}"
                                href="{{ route('showTransactions') }}">
                                Manage Transaction</a>
                        </li>
                    @endif
                </ul>
                <form class="d-flex" action="{{ route('doSearch') }}" method="GET">
                    @csrf
                    <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
                    <button type="button" class="btn btn-outline-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z">
                            </path>
                        </svg>
                    </button>
                </form>

                <div class="btn-group">
                    <button type="button" class="btn btn-info btn-sm dropdown-toggle ms-2 bg-transparent p-0 border-none"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg width=40 height=40 xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 48 48"
                            viewBox="0 0 48 48" id="profile">
                            <path
                                d="M24,6C14.1,6,6,14.1,6,24s8.1,18,18,18s18-8.1,18-18S33.9,6,24,6z M24,13c2.2,0,4,1.8,4,4c0,2.2-1.8,4-4,4c-2.2,0-4-1.8-4-4C20,14.8,21.8,13,24,13z M14,34c0-5.5,4.5-10,10-10c5.5,0,10,4.5,10,10H14z">
                            </path>
                        </svg>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <p class="dropdown-item">Hi {{ Auth::user()->role }}</p>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @if (Auth::user()->role == 'Member')
                            <li><a class="dropdown-item {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}"
                                    href="{{ route('profile') }}">Profile</a></li>
                            <li><a class="dropdown-item {{ Route::currentRouteName() == 'showCart' ? 'active' : '' }}"
                                    href="{{ route('showCart') }}">Cart</a></li>
                        @endif
                        <li><a class="dropdown-item" href="{{ route('doLogout') }}">Logout</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>
    @if (session('msg-success'))
        <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
            <strong>{{ session('msg-success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('msg-error'))
        <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
            <strong>{{ session('msg-error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @yield('page-content')
@endsection
