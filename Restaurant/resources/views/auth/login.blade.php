<!doctype html>
<html lang="en">
  <head>
    <title>Login User</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="d-flex justify-content-center align-item-center p-4 mt-5">
      <form method="post" action="{{ route('do_login') }}" class="container bg-light col-4  rounded shadow-sm">
        @csrf
        @if (Session::has('error'))
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{Session::get('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <div class="container d-flex justify-content-center align-item-center ">
          <h2 class="display-6">LOGIN</h2>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input id="email" class="form-control" type="text" name="email" placeholder="Enter your email">
          <span class="text-danger">
              @error('email')
                  {{$message}}
              @enderror
          </span>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input id="password" class="form-control" type="text" name="password" placeholder="Enter your password">
          <span class="text-danger">
              @error('password')
                  {{$message}}
              @enderror
          </span>
        </div>
        
        <div class="form-group d-flex justify-content-center">
          <button type="submit" class="btn btn-success">Login</button>
        </div>
      </form>
    </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="/js/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>