@extends('dasar')

@section('beranda', 'active')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Pondok Cerdas
                <small>Beranda</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @if(session('success') != null)
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fa fa-check"></i> Berhasil!</h5>
                    {!! session('success') !!}
                </div>
            @endif
            @if(session('warning') != null)
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fa fa-exclamation-triangle"></i> Ada yang salah!</h5>
                    {!! session('warning') !!}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>Aksi</h3>

                            <p>Peminjaman Baru</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pin"></i>
                        </div>
                        <a style="cursor: pointer" data-toggle="modal" data-target="#modal-default3" class="small-box-footer">Klik Disini <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{\App\Buku::all()->count()}} - {{\App\Buku::all()->sum('stok')}}</h3>

                            <p>Jumlah Jenis Buku - Stok Buku</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-book"></i>
                        </div>
                        <a href="/buku" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{\App\Peminjam::all()->count()}}</h3>

                            <p>Jumlah Peminjam Yang Terdaftar</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="/peminjam" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{\App\Transaksi::where('status',0)->get()->count()}}</h3>

                            <p>Jumlah Buku Yang Di Pinjam</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Data Peminjaman Yang Jatuh Tempo Hari Ini</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example3" class="table table-bordered table-hover table-striped table-responsive">
                                    <thead>
                                    <tr>
                                        <th style="width: 2%">#</th>
                                        <th>Peminjam</th>
                                        <th>Judul Buku</th>
                                        <th>Tgl. Pinjam</th>
                                        <th>Tgl. Kembali</th>
                                        <th>Durasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(\App\Transaksi::where('status',0)->where('sampai','=',\Carbon\Carbon::now()->format('Y-m-d'))->get()->reverse() as $x => $y)
                                        <tr>
                                            <td>{{$x+1}}</td>
                                            <td><a style="cursor: pointer" onclick="rincianpeminjam({{\App\Peminjam::where('id',$y->peminjam_id)->first()->id}})">{{\App\Peminjam::where('id',$y->peminjam_id)->first()->nama}}</a></td>
                                            <td><a style="cursor: pointer" onclick="rincianbuku({{\App\Buku::where('id',$y->buku_id)->first()->id}})">{{\App\Buku::where('id',$y->buku_id)->first()->judul}}</a> </td>
                                            <td>{{$y->dari}}</td>
                                            <td>{{$y->sampai}}</td>
                                            <td>{{$y->durasi}}</td>
                                            <td><div class="btn-group">
                                                    <button type="button" class="btn btn-success" data-toggle="dropdown">Aksi</button>
                                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a onClick='javascript:return confirm("Konfirmasi!");' href="/transaksikembali/{{$y->id}}">Dikembalikan</a></li>
                                                    </ul>
                                                </div></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Data Peminjaman Telat Mengembalikan</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover table-striped table-responsive">
                                    <thead>
                                    <tr>
                                        <th style="width: 2%">#</th>
                                        <th>Peminjam</th>
                                        <th>Judul Buku</th>
                                        <th>Tgl. Pinjam</th>
                                        <th>Tgl. Kembali</th>
                                        <th>Durasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(\App\Transaksi::where('status',0)->where('sampai','<',\Carbon\Carbon::now()->format('Y-m-d'))->get()->reverse() as $x => $y)
                                        <tr>
                                            <td>{{$x+1}}</td>
                                            <td><a style="cursor: pointer" onclick="rincianpeminjam({{\App\Peminjam::where('id',$y->peminjam_id)->first()->id}})">{{\App\Peminjam::where('id',$y->peminjam_id)->first()->nama}}</a></td>
                                            <td><a style="cursor: pointer" onclick="rincianbuku({{\App\Buku::where('id',$y->buku_id)->first()->id}})">{{\App\Buku::where('id',$y->buku_id)->first()->judul}}</a> </td>
                                            <td>{{$y->dari}}</td>
                                            <td>{{$y->sampai}}</td>
                                            <td>{{$y->durasi}}</td>
                                            <td><div class="btn-group">
                                                    <button type="button" class="btn btn-success" data-toggle="dropdown">Aksi</button>
                                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a onClick='javascript:return confirm("Konfirmasi!");' href="/transaksikembali/{{$y->id}}">Dikembalikan</a></li>
                                                    </ul>
                                                </div></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Peminjaman</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-hover table-striped table-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 2%">#</th>
                                    <th>Peminjam</th>
                                    <th>Judul Buku</th>
                                    <th>Tgl. Pinjam</th>
                                    <th>Tgl. Kembali</th>
                                    <th>Durasi</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(\App\Transaksi::where('status',0)->get()->reverse() as $x => $y)
                                    <tr>
                                        <td>{{$x+1}}</td>
                                        <td><a style="cursor: pointer" onclick="rincianpeminjam({{\App\Peminjam::where('id',$y->peminjam_id)->first()->id}})">{{\App\Peminjam::where('id',$y->peminjam_id)->first()->nama}}</a></td>
                                        <td><a style="cursor: pointer" onclick="rincianbuku({{\App\Buku::where('id',$y->buku_id)->first()->id}})">{{\App\Buku::where('id',$y->buku_id)->first()->judul}}</a> </td>
                                        <td>{{$y->dari}}</td>
                                        <td>{{$y->sampai}}</td>
                                        <td>{{$y->durasi}}</td>
                                        <td><div class="btn-group">
                                                <button type="button" class="btn btn-success" data-toggle="dropdown">Aksi</button>
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a onClick='javascript:return confirm("Konfirmasi!");' href="/transaksikembali/{{$y->id}}">Dikembalikan</a></li>
                                                </ul>
                                            </div></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- Main row -->

        </section>
        <!-- /.content -->
    </div>

    <div class="modal fade" id="modal-default3">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Peminjaman</h4>
                </div>
                <div class="modal-body">
                    <form role="form" action="/transaksitambah" method="POST">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Peminjam</label>
                                <select name="peminjam_id" class="form-control select2" id="exampleInputEmail1" style="width: 100%;" required>
                                    <option value="" selected disabled>Pilih..</option>
                                    @foreach(\App\Peminjam::all() as $x)
                                        <option value="{{$x->id}}">{{$x->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Buku</label>
                                <select name="buku_id" class="form-control select2" id="exampleInputEmail2" style="width: 100%;" required>
                                    <option value="" selected disabled>Pilih..</option>
                                    @foreach(\App\Buku::all() as $x)
                                        <option value="{{$x->id}}">{{$x->judul}} - {{$x->stok}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tanggal Peminjaman</label>
                                <input type="date" name="dari" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tanggal Akan Dikembalikan</label>
                                <input type="date" name="sampai" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Ketikkan "YA" tanpa tanda petik untuk konfirmasi</label>
                                <input type="text" name="konfirmasi" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <button id="submitform" type="submit" hidden></button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="button" onclick="$('#submitform').trigger('click');" class="btn btn-primary">Simpan</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    <!-- /.modal-dialog -->
    <div class="modal fade" id="modal-default2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Rincian Peminjam</h4>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama</label>
                                <input type="text" name="nama" class="form-control" id="exampleInputEmail11" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">No. Telp</label>
                                <div class="input-group">
                                    <input type="number" name="no_telfon" class="form-control" id="exampleInputPassword11" readonly>

                                    <div class="input-group-addon">
                                        <a id="nomortelp" href="tel:"><i class="fa fa-phone"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Medsos</label>
                                <input type="text" name="nama_media" class="form-control" id="exampleInputPassword2" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">ID Medsos</label>
                                <input type="text" name="iden_media" class="form-control" id="exampleInputPassword3" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Alamat</label>
                                <input type="text" name="alamat" class="form-control" id="exampleInputPassword4" readonly>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- /.modal-dialog -->
    <div class="modal fade" id="modal-default5">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Rincian Buku</h4>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Judul</label>
                                <input type="text" name="judul" class="form-control" id="exampleInputEmail1x" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Pengarang</label>
                                <input type="text" name="pengarang" class="form-control" id="exampleInputPassword1x" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Penerbit</label>
                                <input type="text" name="penerbit" class="form-control" id="exampleInputPassword2x" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tahun</label>
                                <input type="number" name="tahun" class="form-control" id="exampleInputPassword3x" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Donatur</label>
                                <input type="text" name="donatur" class="form-control" id="exampleInputPassword4x" readonly>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@endsection

@push('script')
    <!-- DataTables -->
    <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    <!-- Select2 -->
    <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
    <script>
        $(function () {
            $('#example1').DataTable({
                responsive: true,
                "bSort" : false
            }),
                $('#example2').DataTable({
                    responsive: true,
                    "bSort" : false
                }),
                $('#example3').DataTable({
                    responsive: true,
                    "bSort" : false
                })
        })
        $(document).ready(function() {
            $('.select2').select2();
        });
        function rincianpeminjam(id) {
            $.ajax({
                type: 'get',
                url: "/peminjamget/"+id,
                cache: false,
                success: function(response){
                    $('#exampleInputEmail11').val(response['nama']);
                    $('#exampleInputPassword11').val(response['no_telfon']);
                    $('#nomortelp').attr('href',"tel:"+response['no_telfon']);
                    $('#exampleInputPassword2').val(response['nama_media']);
                    $('#exampleInputPassword3').val(response['iden_media']);
                    $('#exampleInputPassword4').val(response['alamat']);
                    $("#modal-default2").modal('show');
                }
            });
        }
        function rincianbuku(id) {
            $.ajax({
                type: 'get',
                url: "/bukuget/"+id,
                cache: false,
                success: function(response){
                    $('#exampleInputEmail1x').val(response['judul']);
                    $('#exampleInputPassword1x').val(response['pengarang']);
                    $('#exampleInputPassword2x').val(response['penerbit']);
                    $('#exampleInputPassword3x').val(response['tahun']);
                    $('#exampleInputPassword4x').val(response['donatur']);
                    $("#modal-default5").modal('show');
                }
            });
        }
    </script>
@endpush

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
@endpush
