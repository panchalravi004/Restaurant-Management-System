@extends('layouts.home')
@push('title')
    Manage Table
@endpush
@section('content')
    
<div class="row justify-content-end align-items-center g-2 p-3 bg-light border-bottom">
    <div class="col-2">
        {{-- <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="in-active" id="cb-in-active">
            In Active Table
          </label>
        </div> --}}
    </div>
    <div class="col-4 col-xl-2">
        <a class="btn btn-success btn-sm text-white" href=" {{ route('generate_code') }} " target="__BLANK">Generate QR</a>
    </div>
    <div class="col-4 col-xl-2">
        <button type="button" class="btn btn-info btn-sm" id="btn-add-table" data-toggle="modal" data-target="#add-table-modal">ADD TABLE</button>
    </div>
</div>
<div id="filter-content">
    <span class="badge badge-warning text-white rounded-pill">
        Non AC
    </span>
    <div class="row justify-content-around align-items-center g-2 p-3 border-bottom">
        @foreach ($table as $t)
            @if ($t->section == "AC")
                @continue
            @endif
            @php
                $items = getTableItems($t->id);
            @endphp
            <div class="card m-3 ml-4 mr-4 border-0 shadow-sm" id="table-card">
                <div class="card-header @if ($items->count()>0) bg-success @else bg-danger @endif text-white rounded-bottom shadow-sm border-0">
                    Table {{$t->name}}
                </div>
                <div class="card-body" data-toggle="modal" data-target="#detail-table-modal-{{$t->id}}" style="cursor: pointer;">
                    <p class="card-text flex-wrap">Rs. {{getTableTotal($items)}}</p>
                </div>
                <div class="card-footer d-flex justify-content-around border-0 rounded-top">
                    @if ($items->count()>0)
                        <a href="{{ route('close_table', ['id'=>$t->id]) }}" class="btn-sm btn-primary text-white" onclick="show_my_receipt({{$t->id}})">
                            <i class="fa fa-print" aria-hidden="true"></i>
                        </a>
                    @else
                        <a href="{{ route('delete_tables', ['id'=>$t->id]) }}" class="btn-sm btn-danger text-white">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    @endif
                    
                </div>
                {{-- <div class="card-footer d-flex justify-content-around">
                    <span class="badge badge-danger">
                        Inactive
                    </span>
                </div> --}}
            </div>
        @endforeach
    </div>
    <span class="badge badge-warning text-white rounded-pill">
        AC
    </span>
    <div class="row justify-content-around align-items-center g-2 p-3 border-bottom">
        @foreach ($table as $t)
            @if ($t->section == "NOAC")
                @continue
            @endif        
            @php
                $items = getTableItems($t->id);
            @endphp
            <div class="card m-3 ml-4 mr-4 border-0 shadow-sm" id="table-card">
                <div class="card-header @if ($items->count()>0) bg-success @else bg-danger @endif text-white rounded-bottom shadow-sm border-0">
                    Table {{$t->name}}
                </div>
                <div class="card-body" data-toggle="modal" data-target="#detail-table-modal-{{$t->id}}" style="cursor: pointer;">
                    <p class="card-text flex-wrap">Rs. {{getTableTotal($items)}}</p>
                </div>
                <div class="card-footer d-flex justify-content-around border-0 rounded-top">
                    @if ($items->count()>0)
                        <a href="{{ route('close_table', ['id'=>$t->id]) }}" class="btn-sm btn-primary text-white" onclick="show_my_receipt({{$t->id}})">
                            <i class="fa fa-print" aria-hidden="true"></i>
                        </a>
                    @else
                        <a href="{{ route('delete_tables', ['id'=>$t->id]) }}" class="btn-sm btn-danger text-white">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    @endif
                    
                </div>
                {{-- <div class="card-footer d-flex justify-content-around">
                    <span class="badge badge-danger">
                        Inactive
                    </span>
                </div> --}}
            </div>
        @endforeach
    </div>
    
    <!-- Single Table Detail Model Detail Like Table Name , is active or not , if active then how many item is their add , add new items also -->
    {{-- {{getTableItems(1)}} --}}
    
    @foreach ($table as $t)
        @php
            $items = getTableItems($t->id);
        @endphp
    
        @if (Session::has('ITEM-ACTION'))
            <script>
                $(document).ready(function(){
                    $("#detail-table-modal-"+{{Session::get('ITEM-ACTION')}}).modal('show');
                });
            </script>
        @endif
    
        <div class="modal" id="detail-table-modal-{{$t->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h5 class="modal-title">Table {{$t->name}}</h5>
                        @if ($items->count()>0)
                            <span class="badge badge-success rounded-pill m-2">Active</span>
                        @else
                            <span class="badge badge-danger rounded-pill m-2">Inactive</span>
                        @endif
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-header">
                        <form action="{{ route('add_item_in_tables', ['table_id'=>$t->id]) }}">
                            <div class="row justify-content-around align-items-center g-2">
                                <div class="form-group">
                                    <label for="">Select Item</label>
                                    <select class="custom-select" name="product-id" id="">
                                        <option value="" selected>Select one</option>
                                        @foreach ($product as $p)
                                            <option value="{{$p->id}}">{{$p->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                <label for="">Qty</label>
                                <input type="number" name="quantity" value="1" min="1" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                </div>
                                
                                <button type="submit" class="btn btn-primary mt-3 ">ADD</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="modal-body">
                        {{-- {{getTableItems(1)}} --}}
                        @foreach ($items as $item)
                            
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col-1">{{ $loop->index +1}}</div>
                                <div class="col ">{{$item->getProduct[0]->name}}</div>
                                <div class="col-2 ">
                                    <a name="" id="" class="badge badge-secondary" href="{{ route('manage_item', ['action'=>'INC','id'=>$item->id]) }}" role="button">+</a>
                                    {{$item->quantity}}
                                    <a name="" id="" class="badge badge-secondary" href="{{ route('manage_item', ['action'=>'DEC','id'=>$item->id]) }}" role="button">-</a>
                                </div>
                                <div class="col-2 ">{{$item->total}}</div>
                                <div class="col-2 d-flex justify-content-center align-items-center ">
                                    <a href="{{ route('remove_item_in_tables', ['id'=>$item->id]) }}" class="badge badge-danger text-white">&times;</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <form class="modal-footer justify-content-between" action="{{ route('close_table', ['id'=>$t->id]) }}" method="get">
                        <h5 class="mt-2">Rs. {{getTableTotal($items)}}</h5>
                        @if ($items->count()>0)
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="is_parcel" id="" value="checkedValue">
                                Is Parcel
                                </label>
                            </div>
                            <button type="submit" class="btn btn-success text-white" onclick="show_my_receipt({{$t->id}})">Close Table</button>
                            {{-- <button type="button" class="btn btn-primary">Print</button> --}}
                        @endif
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>


<!--Add New Table Modal -->
<div class="modal fade" id="add-table-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" action="{{ route('create_tables') }}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add New Table</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="table-name">Table Name</label>
                  <input type="text" name="name" id="table-name" class="form-control" placeholder="Enter table name" aria-describedby="helpId">
                </div>
                <div class="form-group">
                  <label for="section">Section</label>
                  <select class="form-control" name="section" id="section">
                    <option value="AC">AC</option>
                    <option value="NOAC">Non AC</option>
                  </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
     function show_my_receipt(id) {
         
         // open the page as popup //
         var page = '/tables/bill-print/'+id;
         var myWindow = window.open(page, "_blank", "scrollbars=yes,width=600,height=600,top=30");
         
         // focus on the popup //
         myWindow.focus();
         
         // if you want to close it after some time (like for example open the popup print the receipt and close it) //
         
        //  setTimeout(function() {
        //    myWindow.close();
        //  }, 1000);
        
       }
</script>

@endsection
@section('script')
    var currentElement = "#btn-managetables"
@endsection