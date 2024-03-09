@extends('admin.layouts.app',['page' => 'Dashboard'])

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Penduduk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Home</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tentang Aplikasi</h3>

          <div class="card-tools">
          </div>
        </div>
        <div class="card-body">
          Data Penduduk adalah aplikasi manajemen data penduduk atau aplikasi pencatatan data penduduk.<br>
          Tujuannya adalah untuk memungkinkan pengguna untuk memasukkan, menyimpan, dan mengakses informasi tentang penduduk, serta melakukan pencarian data berdasarkan kriteria tertentu, seperti nama, alamat, usia, jenis kelamin, dll.
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <!-- PIE CHART -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Sebaran Data RT</h3>
              </div>
              <div class="card-body">
                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-6">
            <!-- PIE CHART -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Sebaran Jenis Kelamin</h3>
              </div>
              <div class="card-body">
                <canvas id="pieChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('js')
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<script>
  $(function () {
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.

    // sebaran data rt
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = {
      labels: [
          'RT 01',
          'RT 02',
          'RT 03',
          'RT 04',
          'RT 05',
          'Tidak Diketahui'
      ],
      datasets: [
        {
          data: [700,500,400,600,300,0],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })

    // sebaran data jenis kelamin
    var pieChartCanvas = $('#pieChart2').get(0).getContext('2d')
    var pieData        = {
      labels: [
          'Laki-Laki',
          'Perempuan',
          'Tidak Diketahui'
      ],
      datasets: [
        {
          data: [700,400,0],
          backgroundColor : ['#f56954', '#00a65a', '#d2d6de'],
        }
      ]
    }
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })




  })
</script>
@endsection
