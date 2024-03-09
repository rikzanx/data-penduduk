@extends('admin.layouts.app',['page' => 'Data Master Penduduk'])

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>DataPenduduk</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Master Data Penduduk</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Master Data Penduduk</h3>
              <br>
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">Tambah Data</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>NIK</th>
                  <th>KK</th>
                  <th>NAMA</th>
                  <th>JK</th>
                  <th>RW</th>
                  <th>RT</th>
                  <th>AKSI</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>1</td>
                  <td>3578113105010002</td>
                  <td>3578113105023422</td>
                  <td>MUHAMMAD RIKZAN</td>
                  <td>LAKI-LAKI</td>
                  <td>002</td>
                  <td>004</td>
                  <td>
                    <a href="#" class="btn btn-secondary">Detail</a>
                  </td>
                </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>KK</th>
                    <th>NAMA</th>
                    <th>JK</th>
                    <th>RW</th>
                    <th>RT</th>
                    <th>AKSI</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade" id="modal-create" aria-modal="true" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Penduduk</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <label for="nik" class="col-sm-2 col-form-label">NIK</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK">
          </div>
        </div>
        <div class="form-group row">
          <label for="nkk" class="col-sm-2 col-form-label">NO KK</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nkk" name="nkk" placeholder="NO KK">
          </div>
        </div>
        <div class="form-group row">
          <label for="nama" class="col-sm-2 col-form-label">NAMA</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nama" name="nama" placeholder="NAMA">
          </div>
        </div>
        <div class="form-group row">
          <label for="tempat_lahir" class="col-sm-2 col-form-label">TEMPAT LAHIR</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="TEMPAT LAHIR">
          </div>
        </div>
        <div class="form-group row">
          <label for="tanggal_lahir" class="col-sm-2 col-form-label">TANGGAL LAHIR</label>
          <div class="col-sm-10">
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="TANGGAL LAHIR">
          </div>
        </div>
        <div class="form-group row">
          <label for="jenis_kelamin" class="col-sm-2 col-form-label">JENIS KELAMIN</label>
          <div class="col-sm-10">
            <select class="custom-select rounded-0" id="jenis_kelamin" name="jenis_kelamin">
              <option value="L">LAKI-LAKI</option>
              <option value="P">PEREMPUAN</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="rw" class="col-sm-2 col-form-label">RW</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="rw" name="rw" placeholder="RW">
          </div>
        </div>
        <div class="form-group row">
          <label for="rt" class="col-sm-2 col-form-label">RT</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="rt" name="rt" placeholder="RT">
          </div>
        </div>
        <div class="form-group row">
          <label for="alamat" class="col-sm-2 col-form-label">ALAMAT</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="ALAMAT">
          </div>
        </div>
        <div class="form-group row">
          <label for="agama" class="col-sm-2 col-form-label">AGAMA</label>
          <div class="col-sm-10">
            <select class="custom-select rounded-0" id="agama" name="agama">
              <option value="ISLAM">ISLAM</option>
              <option value="KRISTEN">KRISTEN</option>
              <option value="KATOLIK">KATOLIK</option>
              <option value="HINDU">HINDU</option>
              <option value="BUDDHA">BUDDHA</option>
              <option value="KHONGHUCU">KHONGHUCU</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="pekerjaan" class="col-sm-2 col-form-label">pekerjaan</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="pekerjaan">
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
  <!-- /.modal -->
@endsection

@section('js')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.fixedHeader.min.js') }}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    // $("#example1").DataTable({
    //   "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    // $('#example2').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": false,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    //   "responsive": true,
    // });
  });
  $(document).ready(function () {
      // Setup - add a text input to each footer cell
      $('#example1 thead tr')
      .clone(true)
      .addClass('filters')
      .appendTo('#example1 thead');
  
      var table = $('#example1').DataTable({
          orderCellsTop: true,
          fixedHeader: true,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
          initComplete: function () {
              var api = this.api();

              // For each column
              api
                  .columns()
                  .eq(0)
                  .each(function (colIdx) {
                      console.log(colIdx);
                      // Set the header cell to contain the input element
                      var cell = $('.filters th').eq(
                          $(api.column(colIdx).header()).index()
                      );
                      var title = $(cell).text();
                      $(cell).html('<input type="text" placeholder="' + title + '" />');

                      // On every keypress in this input
                      $(
                          'input',
                          $('.filters th').eq($(api.column(colIdx).header()).index())
                      )
                          .off('keyup change')
                          .on('change', function (e) {
                              // Get the search value
                              $(this).attr('title', $(this).val());
                              var regexr = '({search})'; //$(this).parents('th').find('select').val();

                              var cursorPosition = this.selectionStart;
                              // Search the column for that value
                              api
                                  .column(colIdx)
                                  .search(
                                      this.value != ''
                                          ? regexr.replace('{search}', '(((' + this.value + ')))')
                                          : '',
                                      this.value != '',
                                      this.value == ''
                                  )
                                  .draw();
                          })
                          .on('keyup', function (e) {
                              e.stopPropagation();

                              $(this).trigger('change');
                              $(this)
                                  .focus()[0]
                                  .setSelectionRange(cursorPosition, cursorPosition);
                          });
                  });
          },
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');;
  });
</script>
@endsection
