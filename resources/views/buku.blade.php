@extends('dasar')

@section('buku', 'active')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Buku
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
                <li class="active">Buku</li>
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
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Buku</h3>
                        </div>
                        <button class="btn btn-app" data-toggle="modal" data-target="#modal-default">
                            <i class="fa fa-plus"></i> Tambah
                        </button>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-hover table-striped table-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 2%">#</th>
                                    <th>Judul</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>Tahun</th>
                                    <th>Stok</th>
                                    <th>Donatur</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $x => $y)
                                <tr>
                                    <td>{{$x+1}}</td>
                                    <td>{{$y->judul}}</td>
                                    <td>{{$y->pengarang}}</td>
                                    <td>{{$y->penerbit}}</td>
                                    <td>{{$y->tahun}}</td>
                                    <td>{{$y->stok}}</td>
                                    <td>{{$y->donatur}}</td>
                                    <td><div class="btn-group">
                                            <button type="button" class="btn btn-success" data-toggle="dropdown">Aksi</button>
                                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a onclick="edit({{$y->id}})">Edit</a></li>
                                                <li class="divider"></li>
                                                <li><a onClick='javascript:return confirm("Apakah benar ingin menghapus {{$y->judul}} ?");' href="/bukuhapus/{{$y->id}}">Hapus</a></li>
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
        </section>
        <!-- /.content -->
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Buku</h4>
                </div>
                <div class="modal-body">
                    <form role="form" action="/bukutambah" method="POST">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Judul</label>
                                <input type="text" name="judul" class="form-control" id="exampleInputEmail1" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Pengarang</label>
                                <input type="text" name="pengarang" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Penerbit</label>
                                <input type="text" name="penerbit" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tahun</label>
                                <input type="number" name="tahun" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Donatur</label>
                                <input type="text" name="donatur" class="form-control" id="exampleInputPassword1">
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
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modal-default2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Buku</h4>
                </div>
                <div class="modal-body">
                    <form role="form" action="/bukuedit" method="POST">
                        @csrf
                        <div class="box-body">
                            <input id="idform" name="id" hidden>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Judul</label>
                                <input type="text" name="judul" class="form-control" id="exampleInputEmail11" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Pengarang</label>
                                <input type="text" name="pengarang" class="form-control" id="exampleInputPassword11" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Penerbit</label>
                                <input type="text" name="penerbit" class="form-control" id="exampleInputPassword2" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tahun</label>
                                <input type="number" name="tahun" class="form-control" id="exampleInputPassword3" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Donatur</label>
                                <input type="text" name="donatur" class="form-control" id="exampleInputPassword4">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Stok</label>
                                <input type="number" name="stok" class="form-control" id="exampleInputPassword5" required>
                            </div>
                            <button id="submitform2" type="submit" hidden></button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="button" onclick="$('#submitform2').trigger('click');" class="btn btn-primary">Simpan</button>
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
                responsive: true
            })
        })

        function edit(id) {
            $.ajax({
                type: 'get',
                url: "/bukuget/"+id,
                cache: false,
                success: function(response){
                    $('#idform').val(response['id']);
                    $('#exampleInputEmail11').val(response['judul']);
                    $('#exampleInputPassword11').val(response['pengarang']);
                    $('#exampleInputPassword2').val(response['penerbit']);
                    $('#exampleInputPassword3').val(response['tahun']);
                    $('#exampleInputPassword4').val(response['donatur']);
                    $('#exampleInputPassword5').val(response['stok']);
                    $("#modal-default2").modal('show');
                }
            });
        }

        function tambahstok(id) {
            $('')
        }
    </script>
@endpush

@push('css')

    <!-- DataTables -->
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css">

@endpush
