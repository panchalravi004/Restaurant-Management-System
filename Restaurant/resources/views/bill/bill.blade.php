<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bill</title>
  <style>
    *{
      font-family: sans-serif;
    }
    #invoice-POS{
      box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
      padding:2mm;
      margin: 0 auto;
      width: 60mm;
      background: #FFF;}
      
    h1{
      font-size: 1.5em;
      color: #222;
    }
    h2{font-size: .8em;}
    h3{
      font-size: 1.2em;
      font-weight: 300;
      line-height: 2em;
    }
    p{
      font-size: .6em;
      color: #666;
      line-height: 1.2em;
    }
    
    #top, #mid,#bot{
      border-bottom: 1px solid #EEE;
    }

    #top{min-height: 100px;}
    #mid{min-height: 80px;} 
    #bot{ min-height: 50px;}

    #top .logo{
      height: 60px;
      width: 60px;
      background-size: 60px 60px;
    }
    .clientlogo{
      float: left;
      height: 60px;
      width: 60px;
      background-size: 60px 60px;
      border-radius: 50px;
    }
    .info{
      display: block;
      margin-left: 0;
    }
    .title{
      float: right;
    }
    .title p{text-align: right;} 
    table{
      width: 100%;
      border-collapse: collapse;
    }
    .tabletitle{
      font-size: .6em;
      background: #EEE;
    }
    .service{border-bottom: 1px solid #EEE;}
    .item{width: 24mm;}
    .itemtext{font-size: .5em;}

    #legalcopy{
      margin-top: 5mm;
    }
    
    .legal{
      text-align: center;
    }
  </style>
</head>
<body>
  
  <div id="invoice-POS">
    
    <center id="top">
      <div class="logo"></div>
      <div class="info"> 
        <h2>Restaurant</h2>
      </div>
    </center>
    
    <div id="mid">
      <div class="info">
        <h2>Contact Info</h2>
        <p> 
            Address : street city, state 0000</br>
            Email   : ravi@gmail.com</br>
            Phone   : +91987654321</br>
        </p>
      </div>
    </div>
    
    
    <div id="bot">

					<div id="table">
						<table>
							<tr class="tabletitle">
								<td class="item"><h2>Item</h2></td>
								<td class="Price"><h2>Price</h2></td>
								<td class="Hours"><h2>Qty</h2></td>
								<td class="Rate"><h2>Total</h2></td>
							</tr>

              @foreach ($items as $item)
                <tr class="service">
                  <td class="tableitem"><p class="itemtext">{{$item->getProduct[0]->name}}</p></td>
                  <td class="tableitem"><p class="itemtext">{{$item->getProduct[0]->price}}</p></td>
                  <td class="tableitem"><p class="itemtext">{{$item->quantity}}</p></td>
                  <td class="tableitem"><p class="itemtext">{{$item->total}}</p></td>
                </tr>
              @endforeach


						</table>
            <table>
              {{-- <tr class="tabletitle">
								<td class="Rate"><h2>Sub Total</h2></td>
								<td class="payment"><h2>Rs. 419.25</h2></td>
							</tr>
              <tr class="tabletitle">
								<td class="Rate"><h2>Dis</h2></td>
								<td class="payment"><h2>Rs. 419.25</h2></td>
							</tr> --}}
							<tr class="tabletitle">
								<td class="Rate"><h2>Payable</h2></td>
								<td class="payment"><h2>Rs. {{$total}}</h2></td>
							</tr>
            </table>
					</div>

					<div id="legalcopy">
						<p class="legal">
              <strong>
                Thank you for comming !
              </strong>
            </p>
					</div>

				</div>
  </div>

</body>
</html>