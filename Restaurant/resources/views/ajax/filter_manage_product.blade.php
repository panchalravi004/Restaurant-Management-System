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