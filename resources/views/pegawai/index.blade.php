@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        Menu Pegawai
                    </div>
                    <div class="card-body">
                        Body
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        Konfirmasi Pembayaran Masuk
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Konfirmasi Pembayaran</h5>
                        <table class="table">
                            <thead>
                                <th>Nomor Tagihan</th>
                                <th>Total</th>
                                <th>ID User</th>
                                <th>Konfirmasi</th>
                            </thead>
                            @foreach($tagihans as $tagihan)
                                <tr>
                                    <td>{{$tagihan->id}}</td>
                                    <td>{{$tagihan->total}}</td>
                                    <td>{{$tagihan->user_id}}</td>
                                    <td>
                                        <form action="{{route('pegawai.prosesTagihan', ['id'=>$tagihan->id])}}" method="POST">
                                            {{csrf_field()}}
                                            <button class="btn btn-success">Check</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
