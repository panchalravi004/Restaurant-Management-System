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
                <th scope="col">Parcel</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderHistory as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->amount}}</td>
                    <td>{{$item->table_name}}</td>
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

@endsection


@section('script')
<script>
  $(document).ready(function () {
    $("#btn-orderhistory").addClass("bg-danger");
    $("#btn-orderhistory").removeClass("text-white-50");
    $("#btn-orderhistory").addClass("text-white");
    var classList = [
        "#btn-dashboard",
        "#btn-managetables",
        "#btn-manageproduct",
        "#btn-managecategory",
        "#btn-manageuser",
        "#btn-orderhistory"];
    for (let i = 0; i < classList.length; i++) {
        if(classList[i]==currentElement){
            continue;
        }
        $(classList[i]).removeClass("bg-danger");
        $(classList[i]).removeClass("text-white");
        $(classList[i]).addClass("text-white-50");
    }
  });
</script>
@endsection