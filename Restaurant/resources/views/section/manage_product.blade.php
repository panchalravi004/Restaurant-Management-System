@extends('layouts.home')
@push('title')
    Manage Product
@endpush
@section('content')
    
<div class="row justify-content-around align-items-center g-2 p-3 bg-light">
    <form class="col-3" method="GET" action="">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="serch by product name">
            <div class="input-group-append">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </form>
    <div class="col-2">
        <select class="custom-select" name="" id="select-filter-product">
            <option value="" selected>Filter</option>
            <option value="ACTIVE">Active</option>
            <option value="INACTIVE">Inactive</option>
        </select>
    </div>
    <div class="col-2">
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add-new-product">ADD PRODUCT</button>
    </div>
</div>

<!-- Product detail table -->
@if (Session::has('error'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    {{Session::get('error')}}
</div>
@endif

<div id="filter-product-content">
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
                @foreach ($product as $p)
                    
                    <tr>
                        <td>{{$p->id}}</td>
                        <td>{{$p->code}}</td>
                        <td>{{$p->name}}</td>
                        <td>{{$p->getSubCategory[0]->name}}</td>
                        <td>{{getMainCategoryById($p->getSubCategory[0]->main_category_id)->name}}</td>
                        <td>Rs. {{$p->price}}</td>
                        <td>{{$p->discount}}%</td>
                        <td>
                            @if ($p->status)
                                <span class="badge badge-success">
                                    ACTIVE
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    INACTIVE
                                </span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-product-{{$p->id}}">EDIT</button>
                        </td>
                        <td>
                            <a href="{{ route('delete_product', ['id'=>$p->id]) }}" class="badge badge-danger p-2 text-white">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row justify-content-center align-items-center g-2">
        {{$product->links("pagination::bootstrap-4")}}
    </div>
    
    <!--Edit Product Modal Modal -->
    @foreach ($product as $p)
        
    <div class="modal fade" id="edit-product-{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <form class="modal-content" method="POST" action="{{ route('edit_product',['id'=>$p->id]) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="">Product Code</label>
                      <input type="text" name="code" value="{{$p->code}}" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                    
                    <div class="form-group">
                      <label for="">Product Name</label>
                      <input type="text" name="name" value="{{$p->name}}" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                      <label for="">Product Category</label>
                      <select class="custom-select" name="sub-category-id" id="">
                        @foreach ($subcategory as $cat)
                            @if ($p->sub_category_id == $cat->id)
                                <option value="{{$cat->id}}" selected>{{$cat->name}}</option>
                            @else
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endif
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="">Product Price</label>
                      <input type="text" name="price" value="{{$p->price}}" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                      <label for="">Product Discount</label>
                      <input type="text" name="discount" value="{{$p->discount}}" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                      <label for="">Product Status</label>
                      <select class="custom-select" name="status" id="">
                            @if ($p->status)
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            @else
                                <option value="1">Active</option>
                                <option value="0" selected>Inactive</option>
                            @endif
                      </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    {{-- <button type="submit" class="btn btn-success">Save</button> --}}
                </div>
            </form>
        </div>
    </div>
    @endforeach
</div>



<!--Add New Product Modal Modal -->
<div class="modal fade" id="add-new-product" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <form class="modal-content" method="POST" action="{{ route('create_product') }}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="">Product Code</label>
                  <input type="text" name="code" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                
                <div class="form-group">
                  <label for="">Product Name</label>
                  <input type="text" name="name" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                  <label for="">Product Category</label>
                  <select class="custom-select" name="sub-category-id" id="">
                    <option value="" selected>Select one</option>
                    @foreach ($subcategory as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Product Price</label>
                  <input type="text" name="price" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                  <label for="">Product Discount</label>
                  <input type="text" name="discount" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                  <label for="">Product Status</label>
                  <select class="custom-select" name="status" id="">
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-success">Update</button> --}}
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#select-filter-product").on("change", function () {
            var object = {
                'filter':$(this).val()
            };

            console.log(object);
            $.ajax({
                type: "get",
                url: "/product",
                data: object,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    $("#filter-product-content").html(response['html']);
                }
            });

        });
    });
</script>


@endsection
@section('script')
var currentElement = "#btn-manageproduct";
@endsection
