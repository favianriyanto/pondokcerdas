@extends('dasar')

@section('riwayat', 'active')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Riwayat Transaksi
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
                <li class="active">Riwayat Transaksi</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Riwayat Transaksi</h3>
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
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(\App\Transaksi::all()->reverse() as $x => $y)
                                    <tr>
                                        <td>{{$x+1}}</td>
                                        <td><a style="cursor: pointer" onclick="rincianpeminjam({{\App\Peminjam::where('id',$y->peminjam_id)->first()->id}})">{{\App\Peminjam::where('id',$y->peminjam_id)->first()->nama}}</a></td>
                                        <td><a style="cursor: pointer" onclick="rincianbuku({{\App\Buku::where('id',$y->buku_id)->first()->id}})">{{\App\Buku::where('id',$y->buku_id)->first()->judul}}</a> </td>
                                        <td>{{$y->dari}}</td>
                                        <td>{{$y->sampai}}</td>
                                        <td>{{$y->durasi}}</td>
                                        <td>@if($y->status == 0)Dipinjam @else Dikembalikan @endif</td>
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
        </section>
        <!-- /.content -->
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

    <script>
        $(function () {
            $('#example1').DataTable({
                responsive: true,
                "bSort" : false
            })
        })
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

@endpush
