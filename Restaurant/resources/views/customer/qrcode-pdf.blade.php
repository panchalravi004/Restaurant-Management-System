<!doctype html>
<html lang="en">
  <head>
    <title>QR Code PDF</title>
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
    </style>
  </head>
  <body>

    <div class="container bg-light">
        <div class="row justify-content-between align-items-center g-2">
            @foreach ($tables as $table)
                
                <div class="col-6 mt-2 mb-2 d-flex justify-content-center align-items-center flex-column">
                    {!! QrCode::size(200)->generate($requestType.$host.':'.$port.'/customer/table/'.$table->id) !!}
                    
                    <span class="badge badge-primary m-2">
                        {{$table->section}} : Table {{$table->name}}
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    
    {{-- {!! QrCode::size(200)->generate('ravi') !!} --}}
    
    
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
  $(document).ready(function () {
    window.print();
    window.close();
  });
</script>
