@extends('layouts.home')
@push('title')
    Manage User
@endpush
@section('content')
    
<div class="row justify-content-around align-items-center g-2 p-3 bg-light">
    <div class="col-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="serch by user name">
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
    <div class="col-3">
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add-new-user">ADD USER</button>
    </div>
</div>
<!-- User Details -->
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">User Name</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Memeber</th>
                <th scope="col" colspan="2" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Ravi Panchal</td>
                <td>ravi@gmail.com</td>
                <td>myPassword</td>
                <td>
                    <span class="badge badge-success rounded-pill">
                        YES
                    </span>
                </td>
                <td>
                    <button type="button" class="btn btn-info btn-sm">EDIT</button>
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



<!--Add New User Modal -->
<div class="modal fade" id="add-new-user" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username" aria-describedby="helpId">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email" aria-describedby="helpId">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="text" name="password" id="password" class="form-control" placeholder="Enter Password" aria-describedby="helpId">
                </div>
                <div class="row justify-content-around align-items-center g-2">
                    <div class="col-5 form-check m-2">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue">
                          Can Manage Tables
                        </label>
                    </div>
                    <div class="col-5 form-check m-2">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue">
                          Can Manage Product
                        </label>
                    </div>
                    <div class="col-5 form-check m-2">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue">
                          Can Manage Category
                        </label>
                    </div>
                    <div class="col-5 form-check m-2">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue">
                          Can Manage User
                        </label>
                    </div>
                    <div class="col-5 form-check m-2">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue">
                          Is Memeber
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Update</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
  <script>
    $(document).ready(function () {
      $("#btn-manageuser").addClass("bg-danger");
      $("#btn-manageuser").removeClass("text-white-50");
      $("#btn-manageuser").addClass("text-white");
      var classList = [
          "#btn-dashboard",
          "#btn-managetables",
          "#btn-manageproduct",
          "#btn-managecategory",
        //   "#btn-manageuser",
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