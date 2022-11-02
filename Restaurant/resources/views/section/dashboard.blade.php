@extends('layouts.home')
@push('title')
    Wellcome, {{ucwords(Auth::user()->name)}}
    {{-- Wellcome, {{Auth::user()}} --}}
@endpush
@section('content')
    
<div class="row justify-content-end align-items-center g-2 p-3 bg-light border-bottom">
  <div class="col-2">
    {{-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modelId">Create Order</button> --}}
  </div>
</div>
@php
    $data = getStatistics();
@endphp

<div class="row justify-content-around align-items-center g-2 p-3 bg-white border-bottom">
    <div class="card shadow-sm m-2 ">
      <div class="card-header bg-success text-white rounded-bottom shadow-sm">
        Today's Revenue
      </div>
      <div class="card-body">
        <p class="card-text text-center">Rs. {{$data['todayRevenue']}}</p>
      </div>
    </div>
    <div class="card shadow-sm m-2 ">
      <div class="card-header bg-info text-white rounded-bottom shadow-sm">
        Today's Order
      </div>
      <div class="card-body">
        <p class="card-text text-center">{{$data['todayOrder']->count()}}</p>
      </div>
    </div>
    <div class="card shadow-sm m-2 ">
      <div class="card-header bg-warning text-white rounded-bottom shadow-sm">
        Today's Parcel
      </div>
      <div class="card-body">
        <p class="card-text text-center">{{$data['todayParcel']->count()}}</p>
      </div>
    </div>
    <div class="card shadow-sm m-2 ">
      <div class="card-header bg-danger text-white rounded-bottom shadow-sm">
        Monthly Revenue
      </div>
      <div class="card-body">
        <p class="card-text text-center">Rs. {{$data['monthRevenue']}}</p>
      </div>
    </div>
    <div class="card shadow-sm m-2 ">
      <div class="card-header bg-success text-white rounded-bottom shadow-sm">
        Monthly Order
      </div>
      <div class="card-body">
        <p class="card-text text-center">{{$data['monthOrder']->count()}}</p>
      </div>
    </div>
</div>
<div class="row justify-content-around align-items-center g-2 bg-white">
  <div class="col-6">
    <canvas id="monthlyRevenueDataChart">
  
    </canvas>
  </div>
  <div class="col-6">
    <canvas id="dailyOrderDataChart">
  
    </canvas>
  </div>

</div>

@endsection

@section('script')
  <script>

//for monthly Revenue Data Chart

    $(function () {
    var data = <?php echo json_encode($monthlyRevenueData);?>;
    var barCanvas = $('#monthlyRevenueDataChart');
    var barChart = new Chart(barCanvas,{
      type:'bar',
      data:{
        labels:['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'],
        datasets:[
          {
            label:'Monthly Revenue Growth, 2022',
            data:data,
            backgroundColor:['blue','red','orange','green']
          }
        ]
      },
      options:{
        scales:{
          yAxes:[{
            ticks:{
              beginAtZero:true
            }
          }]
        }
      }
    });
    });

//for daily Order Data Chart display
    $(function () {

      var days = [];
      for (let i = 0; i < 31; i++) {
        days[i]=i + 1;
      }

      var data = <?php echo json_encode($dailyOrderData);?>;
      var barCanvas = $('#dailyOrderDataChart');
      var barChart = new Chart(barCanvas,{
        type:'line',
        data:{
          labels:days,
          datasets:[
            {
              label:'Dail Order Growth, 2022',
              data:data,
              backgroundColor:['blue','red','orange','green']
            }
          ]
        },
        options:{
          scales:{
            yAxes:[{
              ticks:{
                beginAtZero:true
              }
            }]
          }
        }
      });
     });

    //  Initial script
    $(document).ready(function () {
      $("#btn-dashboard").addClass("bg-danger");
      $("#btn-dashboard").removeClass("text-white-50");
      $("#btn-dashboard").addClass("text-white");
      var classList = [
          // "#btn-dashboard",
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
@endsection