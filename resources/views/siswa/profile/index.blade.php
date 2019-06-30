@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
        @include('siswa/includes/header')
            <div class="col-lg-8">
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
                <div class="card">
                    <div class="card-header">
                        My Profile
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Data Profile</h5>
                        @foreach($users_name as $users)
                        <form action="{{Route('siswa.update', ['id' => $users->id])}}" method="post" enctype="multipart/form-data">
                        @endforeach
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="name" name="name" value="@foreach($users_profile as $user_profile) {{$user_profile->name}} @endforeach">
                        </div>
                        </div>
                        <div class="form-group row">
                            <label for="nomor_induk" class="col-sm-2 col-form-label">NIS</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="nomor_induk" name="nomor_induk" value="@foreach($users_profile as $user_profile) {{$user_profile->nomor_induk}} @endforeach" readonly>
                        </div>
                        </div>
                        <div class="form-group row">
                            <label for="tahun_masuk" class="col-sm-2 col-form-label">Tahun Masuk</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="tahun_masuk" name="tahun_masuk" value="@foreach($users_profile as $user_profile) {{$user_profile->tahun_masuk}} @endforeach" readonly>
                        </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="address" name="address" value="@foreach($users_profile as $user_profile) {{$user_profile->address}} @endforeach">
                        </div>
                        </div>
                        <div class="form-group row">
                            <label for="Orangtua_wali" class="col-sm-2 col-form-label">Nama Orang Tua/Wali</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="Orangtua_wali" name="Orangtua_wali" value="@foreach($users_profile as $user_profile) {{$user_profile->Orangtua_wali}} @endforeach">
                        </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-5">
                        @foreach($users_profile as $user_profile) 
                            <img class="img-fluid img-round" src="{{asset('userimage/'.$user_profile->image)}}" alt="...">
                        @endforeach
                        </div>
                        <div class="col-sm-5">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                        </div>
                        
                        <a href="{{route('siswa.profile.index')}}" class="btn btn-danger">Batalkan</a>
                        <a href="" class="btn btn-success" data-toggle="modal" data-target="#EditProfileModal">Edit</a>
                            <!-- <input type="submit" class="btn btn-success float-right" value="Bayar"> -->

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
                                        <p>Anda Yakin Ingin Mengedit Profile Anda ?</p>
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
                                </div>
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