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
                            <h5 class="card-title fw-bold">{{ $location->city }}</h5>
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
                            <img src="{{ asset($product->image_path) }}" class="card-img-top" alt="product-image">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bolder">{{ $product->name }}</h5>
                                <p class="card-text mb-5">{{ $product->description }}</p>
                                <div class="flex-grow-1 w-100"></div>
                                <p class="card-text fw-bolder">Rp. {{ number_format($product->price, 0, '.', ',') }}</p>

                                @if (Auth::user()->role == 'Admin')
                                    <div>
                                        <a href="{{ route('editProduct', ['product_id' => $product->id]) }}"
                                            class="btn btn-primary">Edit</a>
                                        <a href="{{ route('doDeleteProduct', ['product_id' => $product->id]) }}"
                                            class="btn btn-danger">Delete</a>
                                    </div>
                                @endif

                                @if (Auth::user()->role == 'Member')
                                    <a href="{{ Auth::user()->cartItems()->where('product_id', $product->id)->exists()? route('doCartDelete', ['product_id' => $product->id]): route('doAddCart', ['product_id' => $product->id]) }}"
                                        class="btn {{ Auth::user()->cartItems()->where('product_id', $product->id)->exists()? 'btn-danger': 'btn-primary' }} w-100 d-flex align-items-center justify-content-center">

                                        @if (Auth::user()->cartItems()->where('product_id', $product->id)->exists())
                                            <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="16" height="16"
                                                fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"></path>
                                            </svg>

                                            Remove From Cart
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="16" height="16"
                                                fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                                                </path>
                                            </svg>
                                            Add To Product
                                        @endif

                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
@endsection
