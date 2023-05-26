@extends('layout.app')


@section('page-head')
    <style>
        .c-form-modal {
            width: min(1000px, 90%)
        }
    </style>
@endsection


@section('page-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="c-form-modal m-auto mt-4 px-5 py-2 bg-light border border-light rounded shadow-lg">
                    <div class="row">
                        <svg width=200 height=200 xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 48 48"
                            viewBox="0 0 48 48" id="profile">
                            <path
                                d="M24,6C14.1,6,6,14.1,6,24s8.1,18,18,18s18-8.1,18-18S33.9,6,24,6z M24,13c2.2,0,4,1.8,4,4c0,2.2-1.8,4-4,4c-2.2,0-4-1.8-4-4C20,14.8,21.8,13,24,13z M14,34c0-5.5,4.5-10,10-10c5.5,0,10,4.5,10,10H14z">
                            </path>
                        </svg>
                    </div>

                    <form action="{{ route('doUpdateProfile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-0">
                            <div class="col">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required
                                    value="{{ Auth::user()->name }}">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required
                                    value="{{ Auth::user()->email }}">
                            </div>
                        </div>

                        <div class="row mt-4 mb-4">
                            <div class="col">
                                <div class="input-group">
                                    <input type="file" name="image"
                                        class="form-control"aria-describedby="input-image-addon" required>
                                    <span class="input-group-text bg-secondary-subtle" id="input-image-addon">Image</span>
                                </div>
                            </div>
                        </div>

                        @if ($errors->update->any())
                            {{-- @if (true) --}}
                            {{-- <p class="text-danger">Error message</p> --}}
                            <p class="text-danger">{{ $errors->update->first() }}</p>
                        @endif

                        <div class="row">
                            <div class="col">
                                <button class="btn btn-primary w-100" type="submit">Save</button>
                            </div>
                        </div>

                    </form>

                    <form action="{{ route('doChangePassword') }}" method="POST">
                        @csrf
                        <div class="row mt-3">
                            <div class="col">
                                <label for="current_password" class="form-label">Enter Current Password</label>
                                <input type="password" class="form-control" id="current_password" name="current_password"
                                    required>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <label for="new_password" class="form-label">Enter New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </div>
                        </div>

                        <div class="row mt-2 mb-4">
                            <div class="col">
                                <label for="new_password_confirmation" class="form-label">Re-enter New Password</label>
                                <input type="password" class="form-control" id="new_password_confirmation"
                                    name="new_password_confirmation" required>
                            </div>
                        </div>

                        @if ($errors->password->any())
                            <p class="text-danger">{{ $errors->password->first() }}</p>
                        @endif

                        <div class="row mt-4 mb-4">
                            <div class="col">
                                <button class="btn btn-danger w-100" type="submit">Change Password</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
