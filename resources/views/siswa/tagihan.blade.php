@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('siswa/includes/header')
            @include('siswa/includes/utils')
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        Tagihan
                    </div>
                    <div class="card-body text-center">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <h5 class="card-title text-center">Total Tagihan</h5>
                            </li>
                            <li class="list-group-item">
                                <h2 class="display-3 text-center">Rp{{($data_tagihan->total)}}</h2>
                                <h5 class="text-center">Transfer ke : 514 050 6844</h5>
                                <h6 class="text-center">Pembayaran akan dikonfirmasi 1x24 Jam</h6>
                                <br>
                                <h3 class="display-5 text-center">No Tagihan : {{$data_tagihan->id}}</h3>

                                <table class="table">
                                    <thead>
                                        <th>Bulan</th>
                                        <th>Biaya</th>
                                    </thead>
                                    @foreach($detail_tagihan as $detail)
                                    <tr>
                                        <td>{{get_month($detail->month)}}</td>
                                        <td>{{$detail->fee}}</td>
                                    </tr>
                                    @endforeach
                                </table>

                            </li>
                            <li class="list-group-item  ">
                                <a href="{{route('siswa.index')}}" class="btn btn-success text-left">Home</a>

                                <br>
                                <form action="{{route('siswa.cancelTagihan', ['id_tagihan'=>$data_tagihan->id])}}" method="POST">
                                    {{csrf_field()}}
                                    @method('DELETE')
                                    <button class="btn btn-danger">Batalkan</button>
                                </form>
                            </li>

                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
