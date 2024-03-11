@extends('admin.layouts.app',['page' => 'Data Kepala Keluarga'])

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
            <li class="breadcrumb-item active">Master Kepala Keluarga</li>
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
                  <th>TGL LAHIR</th>
                  <th>USIA</th>
                  <th>RW</th>
                  <th>RT</th>
                  <th>AKSI</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($penduduks as $index=>$item)
                  <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->nkk }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->tanggal_lahir }}</td>
                    <td>{{ $item->usia }}</td>
                    <td>{{ $item->rw }}</td>
                    <td>{{ $item->rt }}</td>
                    <td>
                      <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#modal-detail{{ $item->id }}"><span class="fas fa-eye"></span></a>
                      <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit{{ $item->id }}"><span class="fas fa-edit"></span></a>
                      <a href="{{ route('kepalakeluarga.show',$item->id) }}" class="btn btn-success"><span class="fas fa-plus"></span></a>
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
  <div class="modal-dialog modal-lg">
    <form action="{{ route('kepalakeluarga.store') }}" method="post">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Penduduk</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="form-group row">
            <label for="nkk" class="col-sm-2 col-form-label">NO KK</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nkk" name="nkk" placeholder="NO KK">
            </div>
          </div>
          <div class="form-group row">
            <label for="nik" class="col-sm-2 col-form-label">NIK</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK">
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
            <label for="rt" class="col-sm-2 col-form-label">RT</label>
            <div class="col-sm-10">
            <select class="custom-select rounded-0" name="rt" id="rt">
                @foreach($rts as $rt)
                  <option value="{{ $rt->name }}">{{ $rt->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="rw" class="col-sm-2 col-form-label">RW</label>
            <div class="col-sm-10">
              <select class="custom-select rounded-0" name="rw" id="rw">
                @foreach($rws as $rw)
                  @if($rw->name==002)
                    <option value="{{ $rw->name }}">{{ $rw->name }}</option>
                  @endif
                @endforeach
              </select>
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
          <div class="form-group row">
            <label for="status_hubungan" class="col-sm-2 col-form-label">STATUS HUBUNGAN</label>
            <div class="col-sm-10">
              <select class="custom-select rounded-0" id="status_hubungan" name="status_hubungan">
                <option value="KEPALA KELUARGA">KEPALA KELUARGA</option>
                <option value="ISTRI">ISTRI</option>
                <option value="ANAK">ANAK</option>
                <option value="CUCU">CUCU</option>
                <option value="LAINNYA">LAINNYA</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
              <label for="keterangan" class="col-sm-2 col-form-label">KETERANGAN</label>
              <div class="col-sm-10">
              <select class="custom-select rounded-0" id="keterangan" name="keterangan">
                <option value="ADA">ADA</option>
                <option value="MENINGGAL">MENINGGAL</option>
                <option value="PINDAH">PINDAH</option>
                <option value="TIDAK DIKETAHUI">TIDAK DIKETAHUI</option>
              </select>
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

@foreach($penduduks as $item)
  <!-- Modal edit -->
  <div class="modal fade" id="modal-edit{{ $item->id }}" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <form action="{{ route('kepalakeluarga.update',$item->id) }}" method="post">
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
              <label for="nkk" class="col-sm-2 col-form-label">NO KK</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nkk" name="nkk" placeholder="NO KK" value="{{ $item->nkk }}">
              </div>
            </div>
            <div class="form-group row">
              <label for="nik" class="col-sm-2 col-form-label">NIK</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" value="{{ $item->nik }}">
              </div>
            </div>
            <div class="form-group row">
              <label for="nama" class="col-sm-2 col-form-label">NAMA</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="NAMA" value="{{ $item->nama }}">
              </div>
            </div>
            <div class="form-group row">
              <label for="tempat_lahir" class="col-sm-2 col-form-label">TEMPAT LAHIR</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="TEMPAT LAHIR" value="{{ $item->tempat_lahir }}">
              </div>
            </div>
            <div class="form-group row">
              <label for="tanggal_lahir" class="col-sm-2 col-form-label">TANGGAL LAHIR</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="TANGGAL LAHIR" value="{{ $item->tanggal_lahir }}">
              </div>
            </div>
            <div class="form-group row">
              <label for="jenis_kelamin" class="col-sm-2 col-form-label">JENIS KELAMIN</label>
              <div class="col-sm-10">
                <select class="custom-select rounded-0" id="jenis_kelamin" name="jenis_kelamin">
                  <option value="L" {{ ($item->jenis_kelamin == 'L')? 'selected':'' }}>LAKI-LAKI</option>
                  <option value="P" {{ ($item->jenis_kelamin == 'P')? 'selected':'' }}>PEREMPUAN</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="rt" class="col-sm-2 col-form-label">RT</label>
              <div class="col-sm-10">
              <select class="custom-select rounded-0" name="rt" id="rt">
                  @foreach($rts as $rt)
                    <option value="{{ $rt->name }}" {{ ($rt->name == $item->rw)?'selected':'' }}>{{ $rt->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="rw" class="col-sm-2 col-form-label">RW</label>
              <div class="col-sm-10">
                <select class="custom-select rounded-0" name="rw" id="rw">
                  @foreach($rws as $rw)
                    <option value="{{ $rw->name }}" {{ ($rw->name == $item->rw)?'selected':'' }}>{{ $rw->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            
            <div class="form-group row">
              <label for="alamat" class="col-sm-2 col-form-label">ALAMAT</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="ALAMAT" value="{{ $item->alamat }}">
              </div>
            </div>
            <div class="form-group row">
              <label for="agama" class="col-sm-2 col-form-label">AGAMA</label>
              <div class="col-sm-10">
                <select class="custom-select rounded-0" id="agama" name="agama">
                  <option value="ISLAM" {{ ("ISLAM" == $item->agama)?'selected':'' }}>ISLAM</option>
                  <option value="KRISTEN" {{ ("KRISTEN" == $item->agama)?'selected':'' }}>KRISTEN</option>
                  <option value="KATOLIK" {{ ("KATOLIK" == $item->agama)?'selected':'' }}>KATOLIK</option>
                  <option value="HINDU" {{ ("HINDU" == $item->agama)?'selected':'' }}>HINDU</option>
                  <option value="BUDDHA" {{ ("BUDDHA" == $item->agama)?'selected':'' }}>BUDDHA</option>
                  <option value="KHONGHUCU" {{ ("KHONGHUCU" == $item->agama)?'selected':'' }}>KHONGHUCU</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="pekerjaan" class="col-sm-2 col-form-label">pekerjaan</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="pekerjaan" value="{{ $item->pekerjaan }}">
              </div>
            </div>
            <div class="form-group row">
              <label for="status_hubungan" class="col-sm-2 col-form-label">STATUS HUBUNGAN</label>
              <div class="col-sm-10">
                <select class="custom-select rounded-0" id="status_hubungan" name="status_hubungan">
                  <option value="KEPALA KELUARGA" {{ ("KEPALA KELUARGA" == $item->status_hubungan)?'selected':'' }}>KEPALA KELUARGA</option>
                  <option value="ISTRI" {{ ("ISTRI" == $item->status_hubungan)?'selected':'' }}>ISTRI</option>
                  <option value="ANAK" {{ ("ANAK" == $item->status_hubungan)?'selected':'' }}>ANAK</option>
                  <option value="CUCU" {{ ("CUCU" == $item->status_hubungan)?'selected':'' }}>CUCU</option>
                  <option value="LAINNYA" {{ ("LAINNYA" == $item->status_hubungan)?'selected':'' }}>LAINNYA</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
                <label for="keterangan" class="col-sm-2 col-form-label">KETERANGAN</label>
                <div class="col-sm-10">
                <select class="custom-select rounded-0" id="keterangan" name="keterangan">
                  <option value="ADA" {{ ("ADA" == $item->keterangan)?'selected':'' }}>ADA</option>
                  <option value="MENINGGAL" {{ ("MENINGGAL" == $item->keterangan)?'selected':'' }}>MENINGGAL</option>
                  <option value="PINDAH" {{ ("PINDAH" == $item->keterangan)?'selected':'' }}>PINDAH</option>
                  <option value="TIDAK DIKETAHUI" {{ ("TIDAK DIKETAHUI" == $item->keterangan)?'selected':'' }}>TIDAK DIKETAHUI</option>
                </select>
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
    <div class="modal-dialog modal-lg">
      <form action="{{ route('kepalakeluarga.update',$item->id) }}" method="post">
        @csrf
        {{ method_field('PATCH') }}
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Detail Data Penduduk</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <h5>Keluarga Penduduk</h5>
                <table class="table">
                  <thead>
                    <tr>
                      <th>NIK</th>
                      <th>NKK</th>
                      <th>NAMA</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($item->anggotas as $keluarga)
                      <tr>
                        <td>{{ $keluarga->nik }}</td>
                        <td>{{ $keluarga->nkk }}</td>
                        <td>{{ $keluarga->nama }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

            </div>
            <div class="form-group row">
              <label for="nkk" class="col-sm-2 col-form-label">NO KK</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nkk" name="nkk" placeholder="NO KK" value="{{ $item->nkk }}" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="nik" class="col-sm-2 col-form-label">NIK</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" value="{{ $item->nik }}" readonly>
              </div>
            </div>
            
            <div class="form-group row">
              <label for="nama" class="col-sm-2 col-form-label">NAMA</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="NAMA" value="{{ $item->nama }}" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="tempat_lahir" class="col-sm-2 col-form-label">TEMPAT LAHIR</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="TEMPAT LAHIR" value="{{ $item->tempat_lahir }}" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="tanggal_lahir" class="col-sm-2 col-form-label">TANGGAL LAHIR</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="TANGGAL LAHIR" value="{{ $item->tanggal_lahir }}" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="tempat_lahir" class="col-sm-2 col-form-label">USIA</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="TEMPAT LAHIR" value="{{ $item->usia }}" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="jenis_kelamin" class="col-sm-2 col-form-label">JENIS KELAMIN</label>
              <div class="col-sm-10">
                <select class="custom-select rounded-0" id="jenis_kelamin" name="jenis_kelamin" disabled>
                  <option value="L" {{ ($item->jenis_kelamin == 'L')? 'selected':'' }}>LAKI-LAKI</option>
                  <option value="P" {{ ($item->jenis_kelamin == 'P')? 'selected':'' }}>PEREMPUAN</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="rt" class="col-sm-2 col-form-label">RT</label>
              <div class="col-sm-10">
              <select class="custom-select rounded-0" name="rt" id="rt" disabled>
                  @foreach($rts as $rt)
                    <option value="{{ $rt->name }}" {{ ($rt->name == $item->rw)?'selected':'' }}>{{ $rt->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="rw" class="col-sm-2 col-form-label">RW</label>
              <div class="col-sm-10">
                <select class="custom-select rounded-0" name="rw" id="rw" disabled>
                  @foreach($rws as $rw)
                    <option value="{{ $rw->name }}" {{ ($rw->name == $item->rw)?'selected':'' }}>{{ $rw->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            
            <div class="form-group row">
              <label for="alamat" class="col-sm-2 col-form-label">ALAMAT</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="ALAMAT" value="{{ $item->alamat }}" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="agama" class="col-sm-2 col-form-label">AGAMA</label>
              <div class="col-sm-10">
                <select class="custom-select rounded-0" id="agama" name="agama" disabled>
                  <option value="ISLAM" {{ ("ISLAM" == $item->agama)?'selected':'' }}>ISLAM</option>
                  <option value="KRISTEN" {{ ("KRISTEN" == $item->agama)?'selected':'' }}>KRISTEN</option>
                  <option value="KATOLIK" {{ ("KATOLIK" == $item->agama)?'selected':'' }}>KATOLIK</option>
                  <option value="HINDU" {{ ("HINDU" == $item->agama)?'selected':'' }}>HINDU</option>
                  <option value="BUDDHA" {{ ("BUDDHA" == $item->agama)?'selected':'' }}>BUDDHA</option>
                  <option value="KHONGHUCU" {{ ("KHONGHUCU" == $item->agama)?'selected':'' }}>KHONGHUCU</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="pekerjaan" class="col-sm-2 col-form-label">pekerjaan</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="pekerjaan" value="{{ $item->pekerjaan }}" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="status_hubungan" class="col-sm-2 col-form-label">STATUS HUBUNGAN</label>
              <div class="col-sm-10">
                <select class="custom-select rounded-0" id="status_hubungan" name="status_hubungan" disabled>
                  <option value="KEPALA KELUARGA" {{ ("KEPALA KELUARGA" == $item->status_hubungan)?'selected':'' }}>KEPALA KELUARGA</option>
                  <option value="ISTRI" {{ ("ISTRI" == $item->status_hubungan)?'selected':'' }}>ISTRI</option>
                  <option value="ANAK" {{ ("ANAK" == $item->status_hubungan)?'selected':'' }}>ANAK</option>
                  <option value="CUCU" {{ ("CUCU" == $item->status_hubungan)?'selected':'' }}>CUCU</option>
                  <option value="LAINNYA" {{ ("LAINNYA" == $item->status_hubungan)?'selected':'' }}>LAINNYA</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
                <label for="keterangan" class="col-sm-2 col-form-label">KETERANGAN</label>
                <div class="col-sm-10">
                <select class="custom-select rounded-0" id="keterangan" name="keterangan" disabled>
                  <option value="ADA" {{ ("ADA" == $item->keterangan)?'selected':'' }}>ADA</option>
                  <option value="MENINGGAL" {{ ("MENINGGAL" == $item->keterangan)?'selected':'' }}>MENINGGAL</option>
                  <option value="PINDAH" {{ ("PINDAH" == $item->keterangan)?'selected':'' }}>PINDAH</option>
                  <option value="TIDAK DIKETAHUI" {{ ("TIDAK DIKETAHUI" == $item->keterangan)?'selected':'' }}>TIDAK DIKETAHUI</option>
                </select>
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

  <!-- Modal Create -->
  <div class="modal fade" id="modal-create-anggota{{ $item->id }}" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <form action="{{ route('kepalakeluarga.store-anggota',$item->id) }}" method="post">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Data Penduduk</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
          <div class="form-group row">
              <label for="nkk" class="col-sm-2 col-form-label">NO KK</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nkk" name="nkk" placeholder="NO KK" value="{{ $item->nkk }}" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="nik" class="col-sm-2 col-form-label">NIK</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK">
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
              <label for="rt" class="col-sm-2 col-form-label">RT</label>
              <div class="col-sm-10">
              <select class="custom-select rounded-0" name="rt" id="rt">
                  @foreach($rts as $rt)
                    <option value="{{ $rt->name }}">{{ $rt->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="rw" class="col-sm-2 col-form-label">RW</label>
              <div class="col-sm-10">
                <select class="custom-select rounded-0" name="rw" id="rw">
                  @foreach($rws as $rw)
                    @if($rw->name==002)
                      <option value="{{ $rw->name }}">{{ $rw->name }}</option>
                    @endif
                  @endforeach
                </select>
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
            <div class="form-group row">
              <label for="status_hubungan" class="col-sm-2 col-form-label">STATUS HUBUNGAN</label>
              <div class="col-sm-10">
                <select class="custom-select rounded-0" id="status_hubungan" name="status_hubungan">
                  <option value="ISTRI">ISTRI</option>
                  <option value="ANAK">ANAK</option>
                  <option value="CUCU">CUCU</option>
                  <option value="LAINNYA">LAINNYA</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
                <label for="keterangan" class="col-sm-2 col-form-label">KETERANGAN</label>
                <div class="col-sm-10">
                <select class="custom-select rounded-0" id="keterangan" name="keterangan">
                  <option value="ADA">ADA</option>
                  <option value="MENINGGAL">MENINGGAL</option>
                  <option value="PINDAH">PINDAH</option>
                  <option value="TIDAK DIKETAHUI">TIDAK DIKETAHUI</option>
                </select>
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
@endforeach

<!-- Modal delete -->
<div class="modal fade" id="modal-default">
      <div class="modal-dialog modal-lg">
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
          <form action="{{ route('kepalakeluarga.destroy', ':id') }}" method="POST" class="delete-form">
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
      <!-- /.modal-dialog modal-lg -->
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
          fixedHeader: false,
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
