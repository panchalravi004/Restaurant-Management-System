@extends('layouts.home')
@push('title')
    Manage Category
@endpush
@section('content')
    
<div class="row justify-content-end align-items-center g-2 p-3 bg-light border-bottom">
    <div class="col-3">
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add-main-category">ADD MAIN CATEGORY</button>
    </div>
    <div class="col-3">
        <button type="button" class="btn btn-warning text-white btn-sm" data-toggle="modal" data-target="#add-sub-category">ADD SUB CATEGORY</button>
    </div>
</div>
<div class="row justify-content-center align-items-center g-2 p-2">
    <div class="col-5 text-secondary">Main Category</div>
    <div class="col-7 text-secondary">Sub Category</div>
</div>
<div class="row justify-content-center align-items-center g-2 p-2 ">
    <div class="col-5">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-1">No</th>
                        <th>Name</th>
                        <th class="col-4 text-center" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Chineses</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm">EDIT</button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-7">
        <div class="table-responsive">
            <table class="table table-hover ">
                <thead>
                    <tr>
                        <th class="col-1">No</th>
                        <th>Name</th>
                        <th>Main Category</th>
                        <th class="col-3 text-center" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Chineses</td>
                        <td>Chineses</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm">EDIT</button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!--Main Category Modal -->
<div class="modal fade" id="add-main-category" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Main Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="">Main Category Name</label>
                  <input type="text" name="" id="" class="form-control" placeholder="Enter Main Category Name" aria-describedby="helpId">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" >Update</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<!--Sub Category Modal -->
<div class="modal fade" id="add-sub-category" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Sub Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="">Sub Category Name</label>
                  <input type="text" name="" id="" class="form-control" placeholder="Enter Sub Category Name" aria-describedby="helpId">
                </div>
                <div class="form-group">
                    <label for="">Main Category</label>
                    <select class="custom-select" name="" id="">
                        <option selected>Select one</option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                    </select>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" >Update</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
  <script>
    $(document).ready(function () {
      $("#btn-managecategory").addClass("bg-danger");
      $("#btn-managecategory").removeClass("text-white-50");
      $("#btn-managecategory").addClass("text-white");
      var classList = [
          "#btn-dashboard",
          "#btn-managetables",
          "#btn-manageproduct",
        //   "#btn-managecategory",
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