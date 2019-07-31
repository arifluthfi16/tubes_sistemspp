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
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @foreach($users_name as $users)
                        <form action="{{route('admin.siswa.update', ['id' => $users->id])}}" method="post">
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
                            <label for="inputPhone" class="col-sm-2 col-form-label">No Hp</label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="phone" name="phone" value="@foreach($users_profile as $user_profile) {{$user_profile->phone}} @endforeach">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputOrangtua" class="col-sm-2 col-form-label">Orang Tua/Wali</label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="Orangtua_wali" name="Orangtua_wali" value="@foreach($users_profile as $user_profile) {{$user_profile->Orangtua_wali}} @endforeach">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputnomorinduk" class="col-sm-2 col-form-label">Nomor Induk</label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="nomor_induk" name="nomor_induk" value="@foreach($users_profile as $user_profile) {{$user_profile->nomor_induk}} @endforeach">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputTahunMasuk" class="col-sm-2 col-form-label">Tahun Masuk</label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="tahun_masuk" name="tahun_masuk" value="@foreach($users_profile as $User_profile) {{$user_profile->tahun_masuk}} @endforeach">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <a href="{{route('admin.siswa.index')}}" class="btn btn-secondary" data-dismiss="modal">Batalkan</a>
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
                                        <p>Anda Yakin Ingin Mengedit Data Profile Siswa ?</p>
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