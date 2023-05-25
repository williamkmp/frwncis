@extends('layout.app')


@section('page-head')
@endsection


@section('page-content')
    <h1>Dump Page</h1>
    <br>
    <div class="container">
        <pre>
            {{ dump(route("dump")) }}
            {{ dump(request()) }}
        </pre>
    </div>
@endsection
