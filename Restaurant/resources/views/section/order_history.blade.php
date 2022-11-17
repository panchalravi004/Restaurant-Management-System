@extends('layouts.home')
@push('title')
    Order History
@endpush
@section('content')

<div class="row justify-content-center align-items-center g-2 p-3 bg-light">

</div>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Amount</th>
                <th scope="col">Table Name</th>
                <th scope="col">Section</th>
                <th scope="col">User Name</th>
                <th scope="col">Parcel</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderHistory as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>Rs. {{$item->amount}}</td>
                    <td>{{$item->table_name}}</td>
                    <td>{{$item->section}}</td>
                    <td>{{$item->username}}</td>
                    <td>
                        @if ($item->is_parcel)
                            <span class="badge badge-success rounded-pill">YES</span>
                        @else
                            <span class="badge badge-danger rounded-pill">NO</span>
                        @endif
                    </td>
                    <td>{{$item->created_at}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="row justify-content-center align-items-center g-2">
    {{$orderHistory->links("pagination::bootstrap-4")}}
</div>

@endsection


@section('script')
    var currentElement = "#btn-orderhistory";
@endsection