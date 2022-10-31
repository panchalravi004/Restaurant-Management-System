@extends('layouts.home')
@push('title')
    Manage Table
@endpush
@section('content')
    
<div class="row justify-content-end align-items-center g-2 p-3 bg-light border-bottom">
    <div class="col-2">
        <select class="custom-select" name="" id="">
          <option selected>ALL</option>
          <option value="">Inactive</option>
        </select>
      </div>
    <div class="col-2">
        <button type="button" class="btn btn-info btn-sm" id="btn-add-table" data-toggle="modal" data-target="#add-table-modal">ADD TABLE</button>
    </div>
</div>
<div class="row justify-content-around align-items-center g-2 p-3 border-bottom">
    <div class="card m-3 shadow-sm" id="table-card">
        <div class="card-header bg-success text-white">
            TABLE 12
        </div>
        <div class="card-body" data-toggle="modal" data-target="#detail-table-modal">
            <p class="card-text flex-wrap">Rs. 12200</p>
        </div>
        <div class="card-footer d-flex justify-content-around">
            <button class="btn-sm btn-danger">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
            <button class="btn-sm btn-primary">
                <i class="fa fa-print" aria-hidden="true"></i>
            </button>
        </div>
    </div>
    <div class="card m-3 shadow-sm" id="table-card">
        <div class="card-header bg-success text-white">
            TABLE 13
        </div>
        <div class="card-body" data-toggle="modal" data-target="#detail-table-modal">
            <p class="card-text flex-wrap">0</p>
        </div>
        <div class="card-footer d-flex justify-content-around">
            <span class="badge badge-danger">
                Inactive
            </span>
        </div>
    </div>
</div>

<!--Add New Table Modal -->
<div class="modal fade" id="add-table-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Table</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="table-name">Table Name</label>
                  <input type="text" name="table-name" id="table-name" class="form-control" placeholder="Enter table name" aria-describedby="helpId">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Single Table Detail Model Detail Like Table Name , is active or not , if active then how many item is their add , add new items also -->

<div class="modal fade" id="detail-table-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title">Table 12</h5>
                <span class="badge badge-success rounded-pill m-2">Active</span>
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
      $("#btn-managetables").addClass("bg-danger");
      $("#btn-managetables").removeClass("text-white-50");
      $("#btn-managetables").addClass("text-white");
      var classList = [
          "#btn-dashboard",
        //   "#btn-managetables",
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