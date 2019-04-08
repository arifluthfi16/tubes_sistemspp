@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('siswa/includes/header')

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
                                <h2 class="display-3 text-center">{{number_format($data_tagihan->total,0)}}</h2>
                                <h5 class="text-center">Transfer ke : 514 050 6844</h5>
                                <h6 class="text-center">Pembayaran akan dikonfirmasi 1x24 Jam</h6>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('siswa.index')}}" class="btn btn-success text-center">Home</a>
                            </li>

                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
