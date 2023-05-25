@extends('layout.app')


@section('page-head')
@endsection


@section('page-content')
    <div class="container mt-4 py-4">

        <h2 class="row">
            @if ($locationSearchResults->isNotEmpty())
                Showing
            @else
                No
            @endif Location Result(s) for {{ $searchString }}
        </h2>

        <div class="row g-4">
            @foreach ($locationSearchResults as $location)
                <div class="col flex-grow-0">
                    <div class="card h-100" style="width: 18rem;">
                        <img src="{{ asset($location->image_path) }}" class="card-img-top h-50" alt="product-image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $location->city }}</h5>
                            <p class="card-text">{{ $location->address }}</p>
                            <p class="card-text">{{ $location->opening_hours }} - {{ $location->closing_hours }}</p>
                            @if (Auth::user()->role == 'Admin')
                                <div>
                                    <a href="{{ route("editLocation", ["location_id" => $location->id]) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route("doDeleteLocation", ["location_id" => $location->id]) }}" class="btn btn-danger">Delete</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <div class="container mt-4 py-4">
        <h2 class="row">
            @if ($productSearchResults->isNotEmpty())
                Showing
            @else
                No
            @endif Product Result(s) for {{ $searchString }}
        </h2>

        <div class="row g-4">
            @foreach ($productSearchResults as $product)
                <div class="col flex-grow-0">
                    <div class="card h-100" style="width: 18rem;">
                        <img src="{{ asset($product->image_path) }}" class="card-img-top h-50" alt="product-image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ number_format($product->price, 0, '.', ',') }}</p>
                            <p class="card-text">{{ $product->description }}</p>
                            @if (Auth::user()->role == 'Admin')
                                <div>
                                    <a href="{{ route("editProduct", ["product_id" => $product->id]) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route("doDeleteProduct", ["product_id" => $product->id]) }}" class="btn btn-danger">Delete</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
