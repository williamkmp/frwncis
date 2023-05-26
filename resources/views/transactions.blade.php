@extends('layout.app')


@section('page-head')
    <style>
        td {
            align-items: center;
        }
    </style>
@endsection


@section('page-content')
    <div class="container-fluid mt-1 p-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">City</th>
                    <th scope="col">Transaction Date</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php($num = 1)
                @forelse  ($transactions as $header)
                    @foreach ($header->transactionDetails as $item)
                        <tr>
                            <th scope="row">{{ $num }}</th>
                            <td scope="col">{{ $header->user->name }}</td>
                            <td scope="col">{{ $header->location->city }}</td>
                            <td scope="col">{{ $header->created_at }}</td>
                            <td scope="col">{{ $item->product_name }}</td>
                            <td scope="col">{{ number_format($item->price, 0, '.', ',') }}</td>
                            <td scope="col">{{ $item->quantity }}</td>
                            <td scope="col">{{ number_format($item->subtotal, 0, '.', ',') }}</td>
                            @php($num++)
                        </tr>
                    @endforeach
                    <tr style="vertical-align: center">
                        <td>&nbsp;</td>
                        <td colspan="3">Total Price: Rp {{ number_format($header->total, 0, '.', ',') }}</td>
                        <td colspan="1">Pickup Status
                            @if ($header->isPicked)
                                <span class="text-success">Picked Up</span>
                            @else
                                <span class="text-danger">Not Picked Up</span>
                            @endif
                        </td>
                        <td colspan="3">
                            <span class="fw-bold">Set Pickup Status</span>
                            <a class="btn btn-primary btn-sm ms-2"
                                href="{{ route('doPickup', ['transaction_id' => $header->id]) }}">
                                Picked Up</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            <p class="text-center">No Transaction</p>
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>


    </div>
@endsection
