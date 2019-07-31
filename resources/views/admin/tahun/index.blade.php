@extends('layouts.app')

@section('content')

    @if(!(sizeof($detail_year) == 0))

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">Menu Admin</div>
                        <div class="card-body">
                            <ul class="list-group">
                                <a href="{{route('admin.siswa.index')}}" class="btn btn-light mb-1" style="text-align: left; color: #333">Daftar Siswa</a>
                                <a href="{{route('admin.pegawai.index')}}" class="btn btn-light mb-1" style="text-align: left; color: #333">Daftar Pegawai</a>
                                <a href="{{route('admin.tahun.index')}}" class="btn btn-light mb-1" style="text-align: left; color: #333">Daftar Tahun Ajaran</a>
                                <a href="{{route('admin.riwayat_tagihan.index')}}" class="btn btn-light mb-1" style="text-align: left; color: #333">Riwayat Tagihan</a>
                                <a href="{{route('admin.riwayat_tagihan.backup')}}" class="btn btn-light mb-1" onclick="confirm('Apakah anda yakin ingin melakukan backu?')" style="text-align: left; color: #333">Backup Database</a>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">Data Tahun Ajaran</div>
                        <div class="card-body">
                            @if($message = Session::get('success'))
                                <div class="alert alert-success" role="alert">
                                    <p>{{$message}}</p>
                                </div>
                            @endif
                            @if(count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">Add Tahun Ajaran</button>
                                <br>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Academic Year</th>
                                    <th scope="col">Fee</th>
                                    <th scope="col">Start Year</th>
                                    <th scope="col">End Year</th>
                                    <td scope="col">Action</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                @foreach($detail_year as $year)
                                    <tr>
                                        <th scope="row">{{$year->id}}</th>
                                        <td>{{$year->academic_year}}</td>
                                        <td>{{$year->fee}}</td>
                                        <td>{{$year->start_year}}</td>
                                        <td>{{$year->end_year}}</td>
                                        <td>
                                            <a href="{{route('admin.tahun.edit', ['id' => $year->id])}}" class="btn btn-success btn-sm">Edit</a>
                                            <a href="{{Route('admin.tahun.delete', ['id' => $year->id])}}" class="btn btn-danger btn-sm" onclick="return confirm('Apa anda ingin melakukan delete?')">Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @else
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">Menu Admin</div>
                        <div class="card-body">
                            <ul class="list-group">
                                <a href="{{route('admin.siswa.index')}}" class="btn btn-light" style="text-align: left; color: #333">Daftar Siswa</a>
                                <a href="{{route('admin.pegawai.index')}}" class="btn btn-light" style="text-align: left; color: #333">Daftar Pegawai</a>
                                <a href="{{route('admin.tahun.index')}}" class="btn btn-light">Daftar Tahun Ajaran</a></ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">Data Tahun Akademik</div>
                        <div class="card-body">
                            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">Add Tahun Ajaran</button>
                            <h5>Data Tahun Akademik Kosong</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.tahun.add')}}" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Fee</label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="name" name="harga">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Banyak Tahun</label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="jumlah" name="jumlah">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection