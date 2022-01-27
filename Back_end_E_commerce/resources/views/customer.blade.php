@extends('layouts.app')
<style>
    .btnMargin {
        margin-left: 25%;
    }
</style>
@section('content')
<div class="content-wrapper">
   

<div class="container-fluid">
    <div class="col-md-6">
            
            <!-- BAR CHART -->
           <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Bar Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      
            <!-- /.card -->

           
           

          </div>
    </div>
    <!-- /.content -->
</div>


<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>

<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<script>
 const bar = document.getElementById('barChart').getContext('2d');
    let bar_data = JSON.parse('{!! json_encode([$customer_active, $customer_inactive]) !!}');
    const barChart = new Chart(bar, {
        type: 'bar',
        data: {
            labels: ['Active', 'Inactive'],
            datasets: [{
                data: bar_data,
                backgroundColor: [
                    'rgba(0, 123, 255, 1)',
                    'rgba(220, 53, 69, 1)',
                ],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend:{
                display: false
            }
        }
    });
</script>
@endsection