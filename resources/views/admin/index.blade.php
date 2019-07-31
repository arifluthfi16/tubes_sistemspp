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
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
