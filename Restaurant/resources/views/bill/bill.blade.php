<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

    <div class="col-12 container-fluid float-left">
      <div class="card">
        <div class="card-header bg-white">
          <div class="row m-1 justify-content-between align-items-center g-2">
            <div class="col-6 text-secondary d-flex justify-content-start">+919876543210</div>
            <div class="col-6 text-secondary d-flex justify-content-end">ravi@gmail.com</div>
          </div>
          <h5 class=" d-flex justify-content-center">Restaurant Invoice</h5>
          <small class=" d-flex justify-content-center">At Po Hadiyol,Himmatnagar, 383001</small>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Name</th>
                  <th scope="col">Price</th>
                  <th scope="col">Qty</th>
                  <th scope="col">Total</th>
                </tr>
              </thead>
              <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($items as $item)
                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$item->getProduct[0]->name}}</td>
                    <td>{{$item->getProduct[0]->price}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>Rs.{{$item->total}}</td>
                  </tr>
                  @php
                      $i++;
                  @endphp
                @endforeach
              </tbody>
            </table>
          </div>
          
        </div>
        <div class="card-footer bg-white">
          <div class="row justify-content-center align-items-center g-2">
            <h5 class="col-6">Total Amount</h5>
            <h5 class="col-6">Rs. {{$total}}</h5>
          </div>
        </div>
        <div class="card-footer text-muted bg-white d-flex justify-content-center">
          Thank You !
        </div>
      </div>
    </div>

      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
<script>
  $(document).ready(function () {
    window.print();
    window.close();
  });
</script>