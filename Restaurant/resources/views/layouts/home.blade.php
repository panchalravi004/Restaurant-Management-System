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
                <a href=" {{ route('dashboard') }} " class="container d-flex justify-content-left align-items-center text-white-50 mt-2 mb-2 p-3 pl-4" id="btn-dashboard">                  
                    Dashboard
                </a>
                <a href=" {{ route('manage_tables') }} " class="container d-flex justify-content-left align-items-center text-white-50 mt-2 mb-2 p-3 pl-4" id="btn-managetables">                  
                    Manage Tables
                </a>
                <a href=" {{ route('manage_product') }} " class="container d-flex justify-content-left align-items-center text-white-50 mt-2 mb-2 p-3 pl-4" id="btn-manageproduct">                  
                    Manage Product
                </a>
                <a href=" {{ route('manage_category') }} " class="container d-flex justify-content-left align-items-center text-white-50 mt-2 mb-2 p-3 pl-4" id="btn-managecategory">                  
                    Manage Category
                </a>
                <a href=" {{ route('manage_user') }} " class="container d-flex justify-content-left align-items-center text-white-50 mt-2 mb-2 p-3 pl-4" id="btn-manageuser">                  
                    Manage User
                </a>
                <a href="" class="container d-flex justify-content-left align-items-center text-white-50 mt-2 mb-2 p-3 pl-4" id="btn-orderhistory">                  
                    Order History
                </a>
              </div>
            </div>
          </div>
          <!-- Content Model goes here -->
          <div class="col-md-10 col-sm-12 bg-white h-100 p-0">
            <div class="container-fluid bg-dark p-3">
              <div class="row justify-content-center align-items-center g-2">
                <div class="col-10">
                  <h6 class="display-6 text-white-50" id="content-section-title">@stack('title')</h6>
                </div>
                <div class="col-2">
                  <button type="button" class="btn btn-danger btn-sm">Logout</button>
                </div>
              </div>
            </div>
            <!-- Tab with different content -->
            <div class="container-fluid" id="content-section">
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
  @yield('script')
</html>