@extends('layout.app')


@section('page-head')
@endsection


@section('page-content')
    <div class="container mt-4 px-5 py-4 bg-light border border-ligh rounded shadow-sm">
        <div class="row">
            <div class="col">
                <h1 class="m-0 fw-bolder">Add Product</h1>
            </div>
        </div>

        <form action="{{ route('doAddProduct') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mt-4">
                <div class="col">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required autofocus>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" required>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col">
                    {{-- <label for="product_type" class="form-label">Product Type</label> --}}
                    <div class="input-group">
                        <span class="input-group-text bg-secondary-subtle" id="select-addon">Product type</span>
                        <select class="form-select" id="product_type" name="product_type" required>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col">
                    {{-- <label for="address" class="form-label">Image</label> --}}
                    <div class="input-group">
                        <input type="file" name="image" class="form-control"aria-describedby="input-image-addon"
                            required>
                        <span class="input-group-text bg-secondary-subtle" id="input-image-addon">Image</span>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="row mt-5">
                    <p class="text-danger">{{ $errors->first() }}</p>
                </div>
            @endif

            <div class="row mt-4 mb-3">
                <div class="col">
                    <button class="btn btn-primary w-100" type="submit">Add Product</button>
                </div>
            </div>

        </form>
    </div>
@endsection
