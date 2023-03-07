@extends('layouts.home')
@push('title')
    Shef Corner
@endpush
@section('content')

<div class="row justify-content-end align-items-center g-2 p-3 bg-light">
    {{-- <button type="button" class="btn btn-primary btn-sm">Any Button</button> --}}
</div>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Time</th>
                <th scope="col">Item</th>
                <th scope="col">Qty</th>
                <th scope="col">Section</th>
                <th scope="col">Table</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr @if ($order->status == 'Pending') class="table-light" @elseif($order->status == 'Preparing') class="table-warning" @else class="table-success"  @endif>
                    <td scope="col">{{getTimeFromDate($order->created_at)}}</td>
                    <td scope="col">{{$order->product_name}}</td>
                    <td scope="col">{{$order->quantity}}</td>
                    <td scope="col">{{$order->section}}</td>
                    <td scope="col">{{$order->table_name}}</td>
                    <td scope="col">{{$order->status}}</td>
                    <td scope="col">
                        @if ($order->status == 'Pending')
                            
                            <a href=" {{ route('update_order_status', ['status'=>'Preparing','id'=>$order->id]) }} " type="button" class="btn btn-info btn-sm">Take</a>
                        @elseif($order->status == 'Preparing')

                            <a href=" {{ route('update_order_status', ['status'=>'Completed','id'=>$order->id]) }} " type="button" class="btn btn-success btn-sm">Complete</a>
                        @else
                            <span class="badge badge-warning badge-pill">
                                <i class="fa-solid fa-check"></i>
                            </span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="row justify-content-center align-items-center g-2">
    {{-- {{$orderHistory->links("pagination::bootstrap-4")}} --}}
</div>


@endsection

@section('script')
  var currentElement = "#btn-shefcorner";
@endsection