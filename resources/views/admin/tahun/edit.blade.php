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
                            <form action="{{route('admin.tahun.update')}}" method="post">
                                {{csrf_field()}}
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Fee</label>
                                        <div class="col-sm-10">
                                            <input type="text" required class="form-control" id="name" name="fee" value="{{$yearData->fee}}">
                                            <input type="text" value="{{$yearData->id}}" name="id" hidden>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <a href="{{route('admin.tahun.index')}}" class="btn btn-secondary" data-dismiss="modal">Batalkan</a>
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