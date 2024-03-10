@extends('admin.layouts.app',['page' => 'Data User'])

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
            <li class="breadcrumb-item active">Master Data User</li>
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
              <h3 class="card-title">Master Data User</h3>
              <br>
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">Tambah Data</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>NAMA</th>
                  <th>EMAIL</th>
                  <th>AKSI</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($users as $index=>$item)
                  <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                      <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#modal-detail{{ $item->id }}"><span class="fas fa-eye"></span></a>
                      <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit{{ $item->id }}"><span class="fas fa-edit"></span></a>
                      <button class="btn btn-danger" onclick="modaldelete({{ $item->id }})"><span class="fas fa-trash"></span></button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
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

<!-- Modal Create -->
<div class="modal fade" id="modal-create" aria-modal="true" role="dialog">
  <div class="modal-dialog">
    <form action="{{ route('user.store') }}" method="post">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Users</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">NAMA</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" placeholder="NAMA">
            </div>
          </div>
          <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">EMAIL</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="email" name="email" placeholder="EMAIL">
            </div>
          </div>
          <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">PASSWORD</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="password" name="password" placeholder="PASSWORD">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </div>
    </form>
  </div>
</div>
  <!-- /.modal create -->

@foreach($users as $item)
  <!-- Modal edit -->
  <div class="modal fade" id="modal-edit{{ $item->id }}" aria-modal="true" role="dialog">
    <div class="modal-dialog">
      <form action="{{ route('user.update',$item->id) }}" method="post">
        @csrf
        {{ method_field('PATCH') }}
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Data Penduduk</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label">NAMA</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="NAMA" value="{{ $item->name }}">
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-2 col-form-label">EMAIL</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" placeholder="EMAIL" value="{{ $item->email }}">
              </div>
            </div>
            <div class="form-group row">
              <label for="password" class="col-sm-2 col-form-label">PASSWORD</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="password" name="password" placeholder="Password kosongi jika tidak diganti" value="">
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="submit" class="btn btn-warning">Edit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
    <!-- /.modal edit -->

  <!-- Modal detail -->
  <div class="modal fade" id="modal-detail{{ $item->id }}" aria-modal="true" role="dialog">
    <div class="modal-dialog">
      <form action="{{ route('user.update',$item->id) }}" method="post">
        @csrf
        {{ method_field('PATCH') }}
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Data Penduduk</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label">NAMA</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="NAMA" value="{{ $item->name }}" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-2 col-form-label">EMAIL</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" placeholder="EMAIL" value="{{ $item->email }}" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="password" class="col-sm-2 col-form-label">PASSWORD</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="password" name="password" placeholder="********" value="" readonly>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
          </div>
        </div>
      </form>
    </div>
  </div>
    <!-- /.modal detail -->
@endforeach

<!-- Modal delete -->
<div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Peringatan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin akan menghapus data ini&hellip;</p>
          </div>
          <form action="{{ route('user.destroy', ':id') }}" method="POST" class="delete-form">
              @csrf
              @method('DELETE')
              <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Delete</button>
              </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal delete -->

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
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- Page specific script -->
<script>
  function modaldelete(id){
        // alert(id);
        var url = $('.delete-form').attr('action');
        $('.delete-form').attr('action',url.replace(':id',id));
        $('#modal-default').modal('show');
    }
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
