<!doctype html>
<html lang="en">
  <head>
    <title>Restaurant Management System</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
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
      a{
        text-decoration: none;
      }
      a:hover{
        text-decoration: none;
      }
    </style>
  </head>
  <body>
    
    <div class="container-fluid bg-dark " style="height: 650px;">
        <div class="row justify-content-center align-items-center g-2 h-100">
          <!-- Menu Model goes here -->
          <div class="col-md-2 col-sm-12  bg-dark p-0 h-100" style="overflow: hidden;overflow-y: scroll;scrollbar-width: none;">
            <!-- Heading -->
            <div class="container-fluid p-2 d-flex justify-content-center bg-dark border-bottom border-secondary ">
              <h3 class="text-white-50 mt-2">Restaurant</h3>
            </div>
            <!-- menu items -->
            <div class="container-fluid" >
              <div class="row">
                <a href=" {{ route('dashboard') }} " class="container d-flex justify-content-left align-items-center text-white-50 mt-2 mb-2 p-3 pl-4" id="btn-dashboard" data-toggle="tooltip" data-placement="right" title="Dashboard">
                  Dashboard
                </a>
                @if (Auth::user()->can_manage_table)
                  <a href=" {{ route('manage_tables') }} " class="container d-flex justify-content-left align-items-center text-white-50 mt-2 mb-2 p-3 pl-4" id="btn-managetables" data-toggle="tooltip" data-placement="right" title="Manage Tables">
                      Manage Tables
                  </a>
                @endif
                @if (Auth::user()->can_manage_product)
                  <a href=" {{ route('manage_product') }} " class="container d-flex justify-content-left align-items-center text-white-50 mt-2 mb-2 p-3 pl-4" id="btn-manageproduct" data-toggle="tooltip" data-placement="right" title="Manage Product">
                      Manage Product
                  </a>
                @endif
                @if (Auth::user()->can_manage_category)
                  <a href=" {{ route('manage_category') }} " class="container d-flex justify-content-left align-items-center text-white-50 mt-2 mb-2 p-3 pl-4" id="btn-managecategory" data-toggle="tooltip" data-placement="right" title="Manage Category">
                      Manage Category
                  </a>
                @endif
                @if (Auth::user()->can_manage_user)
                  <a href=" {{ route('manage_user') }} " class="container d-flex justify-content-left align-items-center text-white-50 mt-2 mb-2 p-3 pl-4" id="btn-manageuser" data-toggle="tooltip" data-placement="right" title="Manage User">
                      Manage User
                  </a>
                @endif
                <a href="{{ route('order_history') }}" class="container d-flex justify-content-left align-items-center text-white-50 mt-2 mb-2 p-3 pl-4" id="btn-orderhistory" data-toggle="tooltip" data-placement="right" title="Order History">
                    Order History
                </a>
              </div>
            </div>
          </div>
          <!-- Content Model goes here -->
          <div class="col-md-10 col-sm-12 bg-white h-100 p-0" style="overflow: hidden;overflow-y: scroll;overscroll-behavior-y: smooth;scrollbar-width: none; ">
            <div class="container-fluid bg-dark p-3">
              <div class="row justify-content-center align-items-center g-2">
                <div class="col-10">
                  <h6 class="display-6 text-white-50" id="content-section-title">@stack('title')</h6>
                </div>
                <div class="col-2">
                  <a href="{{ route('logout') }}" type="button" class="btn btn-danger btn-sm">Logout</a>
                </div>
              </div>
            </div>
            <!-- Tab with different content -->
            <div class="container-fluid" id="content-section" >
              @yield('content')
            </div>
          </div>
        </div>
    </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="/js/jquery-3.3.1.slim.min.js"></script> -->
    <!-- <script src="/js/popper.min.js"></script> -->
    <script src="{{url('/js/jquery.min.js')}}"></script>
    <script src="{{url('/js/bootstrap.min.js')}}"></script>
    <script src="{{url('/js/script.js')}}"></script>
  </body>
  
  <script>
    @yield('script')
     $(document).ready(function () {
        // Initial script to load
      $(currentElement).addClass("bg-danger");
      $(currentElement).removeClass("text-white-50");
      $(currentElement).addClass("text-white");
      var classList = [
          "#btn-dashboard",
          "#btn-managetables",
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
</html>