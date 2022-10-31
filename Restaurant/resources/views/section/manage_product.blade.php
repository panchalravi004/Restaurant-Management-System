@extends('layouts.home')
@push('title')
    Manage Product
@endpush
@section('content')
    
<div class="row justify-content-around align-items-center g-2 p-3 bg-light">
    <div class="col-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="serch by product name">
            <div class="input-group-append">
                <button type="button" class="btn btn-success">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="col-2">
        <select class="custom-select" name="" id="">
            <option selected>Filter</option>
            <option value="">Active</option>
            <option value="">Inactive</option>
            <option value="">Ascending</option>
            <option value="">Decending</option>
        </select>
    </div>
    <div class="col-2">
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add-new-product">ADD PRODUCT</button>
    </div>
</div>

<!-- Product detail table -->
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Code</th>
                <th>Product Name</th>
                <th>Sub category</th>
                <th>Main category</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Status</th>
                <th colspan="2" class="text-center">ACTION</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>#123456</td>
                <td>Vada Pav</td>
                <td>Fast Food</td>
                <td>Chinese</td>
                <td>130</td>
                <td>10</td>
                <td>
                    <span class="badge badge-success">
                        ACTIVE
                    </span>
                </td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm">EDIT</button>
                </td>
                <td>
                    <span class="badge badge-danger p-2 ">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
</div>


<!--Add New Product Modal Modal -->
<div class="modal fade" id="add-new-product" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="">Product Code</label>
                  <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                
                <div class="form-group">
                  <label for="">Product Name</label>
                  <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                  <label for="">Product Category</label>
                  <select class="custom-select" name="" id="">
                    <option selected>Select one</option>
                    <option value="">Food</option>
                    <option value="">Drink</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Product Price</label>
                  <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                  <label for="">Product Discount</label>
                  <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                  <label for="">Product Status</label>
                  <select class="custom-select" name="" id="">
                    <option selected>Select one</option>
                    <option value="">Active</option>
                    <option value="">Inactive</option>
                  </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Update</button>
                <button type="button" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
  <script>
    $(document).ready(function () {
      $("#btn-manageproduct").addClass("bg-danger");
      $("#btn-manageproduct").removeClass("text-white-50");
      $("#btn-manageproduct").addClass("text-white");
      var classList = [
          "#btn-dashboard",
          "#btn-managetables",
        //   "#btn-manageproduct",
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
