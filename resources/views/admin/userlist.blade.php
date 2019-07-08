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
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Daftar Siswa</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <button type="button" class="btn btn-primary mb-3">Add New Siswa</button>
                        <br>
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>   
                            <th scope="col">Nomor Induk</th>
                            <th scope="col">Orang Tua/Wali</th>
                            <th scope="col">Tahun Masuk</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <?= $i = 1; ?>
                        <tbody>
                            <tr>
                            <th scope="row">1</th>
                            <td>@foreach($user_siswa as $user_siswa)
                        {{$user_siswa->name}}
                        @endforeach</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                            <button type="button" class="btn btn-warning btn-sm">Details</button>
                            <button type="button" class="btn btn-success btn-sm">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm">Hapus</button>
                            </td>
                            </tr>
                        </tbody>
                        <?= $i++; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection