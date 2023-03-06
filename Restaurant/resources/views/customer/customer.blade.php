<!doctype html>
<html lang="en">
  <head>
    <title>Customer</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href=" {{ url('/css/bootstrap.min.css') }} " >
    <!-- <link rel="stylesheet" href="css/all.min.css"/> -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <style>
      *{
        margin: 0;
        padding: 0;
        font-family: sans-serif;
      }
      body{
        height: 100vh;
      }
    </style>
  </head>
  <body>

    @php
        $items = getTableItems($table->id);
        $tableTotal = getTableTotal($items);
    @endphp

    <!-- Header -->
    <div class="container-fluid bg-dark pt-2 pb-2">
        <div class="row justify-content-center align-items-center g-2">
        <div class="col-xl-6 col-7">
            <div class="row justify-content-center align-items-center g-2">
                <div class="col-6">
                    <h4 class="text-white badge badge-pill badge-info">{{$table->section}} Table {{$table->name}}</h4>
                </div>
                <div class="col-6">
                    <h5 class="text-white">Rs. {{$tableTotal}}</h5>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-5">
            
            <div class="row justify-content-end align-items-center g-2">
                <div class="col-xl-3 col-6">
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-table-item-modal">Add</button>
                </div>
                <div class="col-xl-3 col-6">
                    <a href="{{ route('close_table', ['id'=>$table->id]) }}" class="btn btn-sm btn-danger" onclick="show_my_receipt({{$table->id}})">Close</a>
                </div>
            </div>

        </div>
       </div>
    </div>

    <!-- Items Section -->
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Item Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{$item->getProduct[0]->name}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->getProduct[0]->price}}</td>
                    <td>{{$item->total}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- {!! QrCode::size(200)->generate('ravi') !!} --}}
    <!-- Add Item Model -->
    <div class="modal fade" id="add-table-item-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title">Add Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-header">
                    <div>
                        <div class="row justify-content-around align-items-center g-2">
                            <div class="form-group col-7">
                              <label for="">Select Item</label>
                              <select class="custom-select" name="product-id" id="product-id">
                                <option value="" selected>Select one</option>
                                @foreach ($product as $p)
                                    <option value="{{$p->id}}">{{$p->name}} - {{$p->price}}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="form-group col-3">
                              <label for="">Qty</label>
                              <input type="number" name="quantity" id="quantity" value="1" class="form-control" placeholder="" min="1" aria-describedby="helpId">
                            </div>
                            
                            <button type="button" class="btn btn-primary mt-3 " onclick="addItemToCart()">ADD</button>
                        </div>
                    </div>
                </div>
                
                <div class="modal-body" id="item-cart">
                    {{-- <div class="row justify-content-center align-items-center g-2">
                        <div class="col-1 ">1</div>
                        <div class="col ">Item Name </div>
                        <div class="col-2 ">Qty</div>
                        <div class="col-2 ">Amt</div>
                        <div class="col-2 d-flex justify-content-center align-items-center ">
                            <span class="badge badge-danger">&times;</span>
                        </div>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="placeOrder()">Place Order</button>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Customer Info Modal -->
    <div class="modal fade" id="customer-info" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Customer Info</h5>
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> --}}
                </div>
                <div class="modal-body">
                    
                    <div class="form-group">
                      <label for="customer_name">Customer Name</label>
                      <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Enter Your Name">
                    </div>
                    <div class="form-group">
                      <label for="phone_number">Phone Number</label>
                      <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Enter Your Phone Number">
                      
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="addCustomerInfo()" class="close" data-dismiss="modal" aria-label="Close">Submit</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="/js/jquery-3.3.1.slim.min.js"></script> -->
    <script src="{{url('/js/jquery.min.js')}}"></script>
    <!-- <script src="/js/popper.min.js"></script> -->
    <script src="{{url('/js/bootstrap.min.js')}}"></script>
    <script src="{{url('/js/script.js')}}"></script>
  </body>
</html>
<script>

    $('#customer-info').modal('hide');

    let cartItem = {};
    // cartItem[10] = 15;
    // console.log(cartItem[10]);

    function addItemToCart() {
        var p = document.getElementById("product-id");
        var q = document.getElementById("quantity").value;

        // cartItem[p] = p in cartItem ? parseInt(cartItem[p]) + parseInt(q)  : parseInt(q);

        cartItem[p.value] = {
            "id" : p.value,
            "name" : p.options[p.selectedIndex].text.split("-")[0],
            "qty"  : p.value in cartItem ? parseInt(cartItem[p.value]["qty"]) + parseInt(q)  : parseInt(q),
            "amt" : parseInt(p.options[p.selectedIndex].text.split("-")[1].trim()) * (p.value in cartItem ? parseInt(cartItem[p.value]["qty"]) + parseInt(q)  : parseInt(q))
        };

        // showItemToCart(cartItem[p.value]);

        console.log(JSON.stringify(cartItem));
        showItemToCart();
    }


    function showItemToCart() {
        var cart = document.getElementById("item-cart");
        cart.innerHTML = '';

        Object.keys(cartItem).forEach((key,i) => {
            
            console.log(JSON.stringify(cartItem[key]));

            var newElement = document.createElement("div");
            newElement.classList.add("row","justify-content-center","align-items-center","g-2");

            newElement.innerHTML = 
            '<div class="col-1 ">'+(i+1)+'</div>'+
            '<div class="col ">'+ cartItem[key]['name'] +'</div>'+
            '<div class="col-2 ">'+ cartItem[key]['qty'] +'</div>'+
            '<div class="col-2 ">'+ cartItem[key]['amt'] +'</div>'+
            '<div class="col-2 d-flex justify-content-center align-items-center ">'+
                '<span class="badge badge-danger" onclick="removeItemFromCart('+key+')">&times;</span>'+
            '</div>';

            cart.appendChild(newElement);

        });

        console.log(cart.innerHTML);
    }

    function removeItemFromCart(key) {
        delete cartItem[key];
        showItemToCart();
    }

    function placeOrder() {

        $(document).ready(function () {
            $.ajax({
                type: "get",
                url:'/customer/table/placeorder/'+<?php echo $table->id;?>,
                data: cartItem,
                dataType: "json",
                success: function (response) {
                    console.log("success");
                }
            });
        });
        // document.location.reload(true);
    }

    function show_my_receipt(id) {
         
         // open the page as popup //
         var page = '/tables/bill-print/'+id;
         var myWindow = window.open(page, "_blank", "scrollbars=yes,width=600,height=600,top=30");
         
         // focus on the popup //
         myWindow.focus();
    }

</script>