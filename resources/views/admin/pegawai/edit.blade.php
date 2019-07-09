@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Menu Admin</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <ul class="list-group">
                            <a href="{{route('admin.siswa.index')}}" class="btn btn-light" style="text-align: left; color: #333">Daftar Siswa</a>
                            <a href="{{route('admin.pegawai.index')}}" class="btn btn-light mb-10" style="text-align: left; color: #333">Daftar Pegawai</a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Data Siswa</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @foreach($users_name as $users)
                        <form action="{{Route('admin.pegawai.update', ['id' => $users->id])}}" method="post">
                        @endforeach
                {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="name" name="name" value="@foreach($users_name as $users) {{$users->name}} @endforeach">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" required class="form-control" id="email" name="email" value="@foreach($users_name as $users) {{$users->email}} @endforeach">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="address" name="address" value="@foreach($users_profile as $user_profile) {{$user_profile->address}} @endforeach">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPhone" class="col-sm-2 col-form-label">NIP</label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="NIP" name="NIP" value="@foreach($users_profile as $user_profile) {{$user_profile->NIP}} @endforeach">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{route('admin.pegawai.index')}}" class="btn btn-secondary" data-dismiss="modal">Batalkan</a>
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#EditProfileModal">Edit</a>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="EditProfileModal" tabindex="-1" role="dialog" aria-labelledby="EditProfileModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EditProfileModalLabel">Edit Profile</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- <form action="{{route('siswa.proses')}}" method="post">
                            {{csrf_field()}}` -->
                                <div class="modal-body">
                                    <div class="form-group">
                                        <p>Anda Yakin Ingin Mengedit Data Profile Pegawai ?</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" value="Edit">
                                </div>
                            <!-- </form> -->
                            </div>
                        </div>
                        </div>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection