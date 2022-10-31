@extends('layouts.home')
@push('title')
    Order History
@endpush
@section('content')
    Hello
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