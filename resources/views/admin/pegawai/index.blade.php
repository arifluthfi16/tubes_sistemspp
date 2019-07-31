@extends('layouts.app')

@section('content')
@if(sizeof($users_profile)!== 0)

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
                    <div class="card-header">Data Siswa</div>
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
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">Add New Pegawai</button>
                        <br>
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Address</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($users_profile as $users_profile)
                            <tr>
                            <th scope="row">{{$i++}}</th>
                            <td>{{$users_profile->name}}</td>
                            <td>{{$users_profile->NIP}}</td>
                            <td>{{$users_profile->address}}</td>
                            <td>
                            <a href="{{route('admin.pegawai.edit', ['id' => $users_profile->id])}}" class="btn btn-success btn-sm">Edit</a>
                            <a href="{{Route('admin.pegawai.delete', ['id' => $users_profile->id])}}" class="btn btn-danger btn-sm">Hapus</a>
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
    <!-- Modal -->
    <div class="modal fade" id="deleteDataModal" tabindex="-1" role="dialog" aria-labelledby="deleteDataModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteDataModalLabel">Delete Data Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{Route('admin.pegawai.delete', ['id' => $users_profile->id])}}" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <p>Anda Yakin ingin menghapus data Pegawai ini?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
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
                            <a href="{{route('admin.siswa.index')}}" class="btn btn-light mb-10" style="text-align: left; color: #333">Daftar Siswa</a>
                            <a href="{{route('admin.pegawai.index')}}" class="btn btn-light mb-10" style="text-align: left; color: #333">Daftar Pegawai</a>
                            <a href="{{route('admin.tahun.index')}}" class="btn btn-light">Daftar Tahun Ajaran</a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Data Pegawai</div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">Add New Pegawai</button>
                        <h5>Data Pegawai Kosong</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->


@endif
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Data Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.pegawai.index')}}" method="post">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control" id="name" name="name" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" required class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">NIP</label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control" id="NIP" name="NIP" placeholder="NIP">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" required class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputRole" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control" id="role" name="role" value="pegawai" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control" id="address" name="address" placeholder="Address">
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