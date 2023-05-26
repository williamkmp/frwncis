@extends('layout.app')


@section('page-head')
    <style>
        .t * {
            border: 1px dashed red;
        }
    </style>
@endsection


@section('page-content')
    <div class="container-fluid mt-4">

        <div class="row">
            <div class="col">
                <h1 class="m-0 text-center">Your Cart</h1>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="container-fluid w-75 mt-4 bg-light border border-light rounded shadow-lg" style="height: 70vh;">
                    <div class="row h-100 p-3">

                        <div class="col h-100 overflow-y-scroll px-2">

                            @foreach ($cartItems as $cartItem)
                                <div class="card mb-2">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="{{ $cartItem->product->image_path }}"
                                                class="img-fluid rounded-start h-100" alt="product cart">
                                        </div>
                                        <div class="col-md-8 d-flex flex-column">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $cartItem->product->name }}</h5>
                                                <p class="card-text fw-bolder">Price:
                                                    {{ number_format($cartItem->product->price, 0, '.', ',') }}</p>
                                                <div class="flex-grow-1"></div>

                                                <div class="d-flex gap-2">

                                                    <a type="button" class="btn btn-danger"
                                                        href="{{ route('doCartItemDecrement', ['product_id' => $cartItem->product->id]) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-dash-circle-fill" viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z">
                                                            </path>
                                                        </svg>
                                                    </a>

                                                    <input class="form-control flex-grow-1" type="number"
                                                        value="{{ $cartItem->quantity }}" disabled readonly>

                                                    <a type="button" class="btn btn-primary"
                                                        href="{{ route('doAddCart', ['product_id' => $cartItem->product->id]) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z">
                                                            </path>
                                                        </svg>
                                                    </a>

                                                    <a type="button" class="btn btn-danger"
                                                        href="{{ route('doCartDelete', ['product_id' => $cartItem->product->id]) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-trash3-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z">
                                                            </path>
                                                        </svg>
                                                    </a>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <form class="col h-100 px-4 d-flex flex-column gap-3" action="{{ route('doCheckout') }}"
                            method="POST">

                            <h2 class="fw-bolder text-center">Cart Summary</h2>
                            <h3 class="fw-normal"> Total Price : Rp. {{ number_format($priceTotal, 2, '.', ',') }}</h3>
                            <h3 class="fw-normal"> Total Item : {{ $itemCount }}(s)</h3>

                            <hr>

                            <h3 class="fw-bolder text-center">Choose Pickup Location</h3>

                            <div class="input-group">
                                <span class="input-group-text bg-secondary-subtle" id="select-addon">Location</span>
                                <select class="form-select" id="product_type" name="product_type" required>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->address }},
                                            {{ $location->city }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row mt-4 mb-3">
                                <div class="col">
                                    <button class="btn btn-primary w-100" type="submit">Checkout</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
