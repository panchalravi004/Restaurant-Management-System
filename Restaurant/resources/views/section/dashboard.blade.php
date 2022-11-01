@extends('layouts.home')
@push('title')
    Wellcome, {{ucwords(Auth::user()->name)}}
    {{-- Wellcome, {{Auth::user()}} --}}
@endpush
@section('content')
    
<div class="row justify-content-end align-items-center g-2 p-3 bg-light border-bottom">
  <div class="col-2">
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modelId">Create Order</button>
  </div>
</div>

<div class="row justify-content-around align-items-center g-2 p-3 bg-white border-bottom">
    <div class="card shadow-sm m-2 ">
      <div class="card-header bg-success text-white">
        Today's Revenue
      </div>
      <div class="card-body">
        <p class="card-text">Rs. 2000</p>
      </div>
    </div>
    <div class="card shadow-sm m-2 ">
      <div class="card-header bg-success text-white">
        Today's Order
      </div>
      <div class="card-body">
        <p class="card-text">Rs. 2000</p>
      </div>
    </div>
    <div class="card shadow-sm m-2 ">
      <div class="card-header bg-success text-white">
        Today's Parcel
      </div>
      <div class="card-body">
        <p class="card-text">Rs. 2000</p>
      </div>
    </div>
    <div class="card shadow-sm m-2 ">
      <div class="card-header bg-success text-white">
        Monthly Revenue
      </div>
      <div class="card-body">
        <p class="card-text">Rs. 2000</p>
      </div>
    </div>
</div>
<div class="row justify-content-around align-items-center g-2 bg-secondary">

</div>


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Order</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-header">
        <form action="">
          <div class="row justify-content-around align-items-center g-2">
            <div class="form-group">
              <label for="">Select Item</label>
              <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <div class="form-group col-3">
              <label for="">Qty</label>
              <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <button type="button" class="btn btn-primary mt-3 ">ADD</button>
          </div>
        </form>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center align-items-center g-2">
          <div class="col-1 ">1</div>
          <div class="col ">Item Name </div>
          <div class="col-2 ">Qty</div>
          <div class="col-2 ">Amt</div>
          <div class="col-2 d-flex justify-content-center align-items-center ">
              <span class="badge badge-danger">&times;</span>
          </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Print</button>
        <h5>Rs. 12000</h5>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
  <script>
    $(document).ready(function () {
      $("#btn-dashboard").addClass("bg-danger");
      $("#btn-dashboard").removeClass("text-white-50");
      $("#btn-dashboard").addClass("text-white");
      var classList = [
          // "#btn-dashboard",
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