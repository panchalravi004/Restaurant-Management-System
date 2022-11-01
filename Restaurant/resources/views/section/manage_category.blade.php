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
<div class="row justify-content-center align-items-start g-2 p-2 ">
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
                    @foreach ($mainCat as $cat)
                        <tr>
                            <td>{{$cat->id}}</td>
                            <td>{{$cat->name}}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-main-category-{{$cat->id}}">EDIT</button>
                            </td>
                            <td>
                                <a href="{{ route('delete_category', ['category'=>"MAIN",'id'=>$cat->id]) }}" type="button" class="btn btn-danger btn-sm text-white">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
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
                    @foreach ($subCat as $cat)    
                        <tr>
                            <td>{{$cat->id}}</td>
                            <td>{{$cat->name}}</td>
                            <td>{{$cat->getMainCategory[0]->name}}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-sub-category-{{$cat->id}}">EDIT</button>
                            </td>
                            <td>
                                <a href="{{ route('delete_category', ['category'=>"SUB",'id'=>$cat->id]) }}" type="button" class="btn btn-danger btn-sm text-white">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<!--Main Category Modal -->
<div class="modal fade" id="add-main-category" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <form class="modal-content" method="post" action="{{ route('add_main_category') }}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add Main Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="">Main Category Name</label>
                  <input type="text" name="name" id="" class="form-control" placeholder="Enter Main Category Name" aria-describedby="helpId">
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-success" >Update</button> --}}
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
<!--Sub Category Modal -->
<div class="modal fade" id="add-sub-category" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <form class="modal-content" method="POST" action="{{ route('add_sub_category') }}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add Sub Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="">Sub Category Name</label>
                  <input type="text" name="name" id="" class="form-control" placeholder="Enter Sub Category Name" aria-describedby="helpId">
                </div>
                <div class="form-group">
                    <label for="">Main Category</label>
                    <select class="custom-select" name="main-category-id" id="">
                        <option selected>Select one</option>
                        @foreach ($mainCat as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
                
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-success" >Update</button> --}}
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<!--Edit Main Category Modal -->
@foreach ($mainCat as $cat)
<div class="modal fade" id="edit-main-category-{{$cat->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <form class="modal-content" method="post" action="{{ route('edit_main_category',['id'=>$cat->id]) }}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Edit Main Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="">Main Category Name</label>
                  <input type="text" name="name" id="" value="{{$cat->name}}" class="form-control" placeholder="Enter Main Category Name" aria-describedby="helpId">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" >Update</button>
                {{-- <button type="submit" class="btn btn-primary">Save</button> --}}
            </div>
        </form>
    </div>
</div>
@endforeach

<!--Edit Sub Category Modal -->
@foreach ($subCat as $cat)
<div class="modal fade" id="edit-sub-category-{{$cat->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <form class="modal-content" method="POST" action="{{ route('edit_sub_category',['id'=>$cat->id]) }}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Edit Sub Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="">Sub Category Name</label>
                  <input type="text" name="name" id="" value="{{$cat->name}}" class="form-control" placeholder="Enter Sub Category Name" aria-describedby="helpId">
                </div>
                <div class="form-group">
                    <label for="">Main Category</label>
                    <select class="custom-select" name="main-category-id" id="">
                        {{-- <option selected>Select one</option> --}}
                        @foreach ($mainCat as $mcat)
                            @if ($cat->main_category_id == $mcat->id)
                                <option value="{{$mcat->id}}" selected>{{$mcat->name}}</option>
                            @else
                                <option value="{{$mcat->id}}">{{$mcat->name}}</option>                        
                            @endif
                        @endforeach
                    </select>
                </div>
                
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-success" >Update</button> --}}
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endforeach
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