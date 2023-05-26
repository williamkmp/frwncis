@extends('layout.app')


@section('page-head')
@endsection


@section('page-content')
    <div class="container mt-4 py-4">

        <div class="row">
            <div class="col position-relative p-0 m-0">
                @if (Auth::user()->role == 'Admin')
                    <a href="{{ route('addLocation') }}"
                        class="position-absolute top-50 start-0 translate-middle-y btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus" viewBox="0 0 16 16">
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                            </path>
                        </svg>
                        Add Location
                    </a>
                @endif
                <h2 class="text-center m-0">Our Locations</h2>
            </div>

            <div class="row g-4">
                @foreach ($locations as $location)
                    <div class="col flex-grow-0">
                        <div class="card h-100" style="width: 18rem;">
                            <img src="{{ asset($location->image_path) }}" class="card-img-top h-50" alt="product-image">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $location->city }}</h5>
                                <p class="card-text">{{ $location->address }}</p>
                                <p class="card-text">{{ $location->opening_hours }} - {{ $location->closing_hours }}</p>
                                @if (Auth::user()->role == 'Admin')
                                    <div>
                                        <a href="{{ route('editLocation', ['location_id' => $location->id]) }}"
                                            class="btn btn-primary">Edit</a>
                                        <a href="{{ route('doDeleteLocation', ['location_id' => $location->id]) }}"
                                            class="btn btn-danger">Delete</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
