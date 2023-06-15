<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Welcome {{ ucfirst(auth()->user()->name) }}</h3>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 grid-margin transparent">
      <div class="row">
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-tale">
            <div class="card-body">
              <p class="mb-4">Today's Earning</p>
              <p class="fs-30 mb-2"><i class="fa-sharp fa-solid fa-indian-rupee-sign"></i> 0.00</p>
              <p></p>
            </div>
          </div>
        </div>
        
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-dark-blue">
            <div class="card-body">
              <p class="mb-4">Last 7 Days Earning</p>
              <p class="fs-30 mb-2"><i class="fa-sharp fa-solid fa-indian-rupee-sign"></i> 0.00</p>
              <p></p>
            </div>
          </div>
        </div>
        </div>

      <div class="row">
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-light-blue">
            <div class="card-body">
              <p class="mb-4">Last 30 Days Earning</p>
              <p class="fs-30 mb-2"><i class="fa-sharp fa-solid fa-indian-rupee-sign"></i> 0.00</p>
              <p></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-light-danger">
            <div class="card-body">
              <p class="mb-4">All Time Earning</p>
              <p class="fs-30 mb-2"><i class="fa-sharp fa-solid fa-indian-rupee-sign"></i> 0.00</p>
              <p></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 grid-margin transparent">
      <div class="row">
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-tale">
            <div class="card-body">
              <p class="mb-4">Passive Income</p>
              <p class="fs-30 mb-2"><i class="fa-sharp fa-solid fa-indian-rupee-sign"></i> 0.00</p>
              <p></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-dark-blue">
            <div class="card-body">
              <p class="mb-4">Total Withdrawal</p>
              <p class="fs-30 mb-2"><i class="fa-sharp fa-solid fa-indian-rupee-sign"></i> 0.00</p>
              <p></p>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 mb-4 stretch-card transparent">
          <div class="card card-light-blue">
            <div class="card-body">
              <p class="mb-4">Net Balance</p>
              <p class="fs-30 mb-2"><i class="fa-sharp fa-solid fa-indian-rupee-sign"></i> 0.00</p>
              <p></p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <div class="row">
    <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
          <p class="card-title mb-0">Recent Sale</p>
          <div class="table-responsive">
            <table class="table table-striped table-borderless">
              <thead>
                <tr>
                  <th class="border-bottom">Sno.</th>
                  <th class="border-bottom">Name</th>
                  <th class="border-bottom">Amount</th>
                </tr>  
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td class="font-weight-bold">David</td>
                  <td><i class="fa-sharp fa-solid fa-indian-rupee-sign"></i> 0.00</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
          <p class="card-title">Sales Growth</p>
          </div>
          <canvas id="sales-growth"></canvas>
        </div>
      </div>
    </div>
  </div>
          
</div>
<!-- End content-wrapper -->

@push('scripts')
<!-- Custom js for this page-->
<script src="{{ asset('admin/assets/chart.js/Chart.min.js') }}"></script>
{{-- 
  <script src="{{ asset('admin/js/dashboard.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin/js/Chart.roundedBarCharts.js') }}" type="text/javascript"></script>
--}}

<script type="text/javascript">
  $(document).ready(function(){
    var weekData = [10, 15, 8, 12];
    var ctx = document.getElementById('sales-growth').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
        datasets: [{
          label: 'Data',
          data: weekData,
          backgroundColor: '#8989d0', // Customize the bar color
          borderColor: '#5050b2', // Customize the bar border color
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true // Start the y-axis from zero
          }
        }
      }
    });

  });
</script>
@endpush