@extends('layouts.home')
@push('title')
    Manage User
@endpush
@section('content')
<div class="row justify-content-around align-items-center g-2 p-3 bg-light">
    <div class="col-3">
        <form class="input-group" method="get" action="">
            <input type="text" class="form-control" name="search" placeholder="serch by user name">
            <div class="input-group-append">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
        </form>
    </div>
    <div class="col-2">
        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="" id="cb-filter-product" value="checkedValue">
            Member Only
          </label>
        </div>
    </div>
    <div class="col-3">
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add-new-user">ADD USER</button>
    </div>
</div>

<div id="filter-user-content">
    <!-- User Details -->
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Member</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $u)    
                    <tr>
                        <td>{{$u->id}}</td>
                        <td>{{ucwords($u->name)}}</td>
                        <td>{{ucwords($u->email)}}</td>
                        <td>
                            @if ($u->is_member)
                                <span class="badge badge-success rounded-pill">
                                    YES
                                </span>
                            @else
                                <span class="badge badge-danger rounded-pill">
                                    NO
                                </span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#edit-user-{{$u->id}}">EDIT</button>
                        </td>
                        <td>
                            <a href="{{ route('delete_user', ['id'=>$u->id]) }}" type="button" class="btn btn-danger btn-sm text-white">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    @foreach ($user as $u)
    <!--Edit User Modal -->
    <div class="modal fade" id="edit-user-{{$u->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <form class="modal-content" method="post" action="{{ route('edit_user',['id'=>$u->id])}}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Edit User | {{ucwords($u->name)}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="name" id="username" value="{{$u->name}}" class="form-control" placeholder="Enter Username" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="{{$u->email}}" class="form-control" placeholder="Enter Email" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password" class="form-control" placeholder="Enter Password" aria-describedby="helpId">
                    </div>
                    <div class="row justify-content-around align-items-center g-2">
                        <div class="col-5 form-check m-2">
                            <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" @if ($u->can_manage_table) checked @else  @endif name="can_manage_table" id="" value="1">
                            Can Manage Tables
                            </label>
                        </div>
                        <div class="col-5 form-check m-2">
                            <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" @if ($u->can_manage_product) checked @else  @endif name="can_manage_product" id="" value="1">
                            Can Manage Product
                            </label>
                        </div>
                        <div class="col-5 form-check m-2">
                            <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" @if ($u->can_manage_category) checked @else @endif name="can_manage_category" id="" value="1">
                            Can Manage Category
                            </label>
                        </div>
                        <div class="col-5 form-check m-2">
                            <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" @if ($u->can_manage_user) checked @else @endif name="can_manage_user" id="" value="1">
                            Can Manage User
                            </label>
                        </div>
                        <div class="col-5 form-check m-2">
                            <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" @if ($u->shef_access) checked @else @endif name="shef_access" id="" value="1">
                            Shef Access
                            </label>
                        </div>
                        <div class="col-5 form-check m-2">
                            <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" @if ($u->is_member) checked @else @endif name="is_member" id="" value="1">
                            Is Member
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    {{-- <button type="submit" class="btn btn-primary">Save</button> --}}
                </div>
            </form>
        </div>
    </div>
    @endforeach
</div>


<!--Add New User Modal -->
<div class="modal fade" id="add-new-user" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <form class="modal-content" method="post" action="{{ route('create_user')}}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="name" id="username" class="form-control" placeholder="Enter Username" aria-describedby="helpId">
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
                          <input type="checkbox" class="form-check-input" name="can_manage_table" id="" value="1">
                          Can Manage Tables
                        </label>
                    </div>
                    <div class="col-5 form-check m-2">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" name="can_manage_product" id="" value="1">
                          Can Manage Product
                        </label>
                    </div>
                    <div class="col-5 form-check m-2">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" name="can_manage_category" id="" value="1">
                          Can Manage Category
                        </label>
                    </div>
                    <div class="col-5 form-check m-2">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" name="can_manage_user" id="" value="1">
                          Can Manage User
                        </label>
                    </div>
                    <div class="col-5 form-check m-2">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" name="shef_access" id="" value="1">
                          Shef Access
                        </label>
                    </div>
                    <div class="col-5 form-check m-2">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" name="is_member" id="" value="1">
                          Is Member
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="submit" class="btn btn-success">Update</button> --}}
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#cb-filter-product").on("change", function () {

            var cb = false;
            if($(this)[0].checked){
                cb = "YES";
            }else{
                cb = "NO";
            }

            var object = {
                'filter':cb
            };

            console.log(object);
            $.ajax({
                type: "get",
                url: "/user",
                data: object,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    $("#filter-user-content").html(response['html']);
                }
            });

        });
    });
</script>

@endsection
@section('script')
    var currentElement = "#btn-manageuser";
@endsection