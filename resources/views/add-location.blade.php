@extends('layout.app')


@section('page-head')
@endsection


@section('page-content')
    <div class="container mt-4 px-5 py-4 bg-light border border-ligh rounded shadow-sm">
        <div class="row">
            <div class="col">
                <h1 class="m-0 fw-bolder">Add Location</h1>
            </div>
        </div>

        <form action="{{ route('doAddLocation') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mt-4">
                <div class="col">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city" required autofocus>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <label for="opening_hours" class="form-label">Opening Hours</label>
                    <input type="time" class="form-control" id="opening_hours" name="opening_hours" required>
                </div>

                <div class="col">
                    <label for="closing_hours" class="form-label">Closing Hours</label>
                    <input type="time" class="form-control" id="closing_hours" name="closing_hours" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <label for="address" class="form-label">Image</label>
                    <div class="input-group mb-3">
                        <input type="file" name="image" class="form-control"aria-describedby="input-image-addon"
                            required>
                        <span class="input-group-text bg-secondary-subtle" id="input-image-addon">Image</span>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="row mt-3">
                    <p class="text-danger">{{ $errors->first() }}</p>
                </div>
            @endif

            <div class="row mt-3 mb-3">
                <div class="col">
                    <button class="btn btn-primary w-100" type="submit">Add Location</button>
                </div>
            </div>

        </form>
    </div>
@endsection
