@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('siswa/includes/header')

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        Kondisi Keuangan
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Laporan Keuangan Siswa</h5>
                        <table class="table table-bordered">
                            <thead>
                                <th>Bulan ke</th>
                                <th>Biaya</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Status</th>
                            </thead>
                            @foreach($payments_info as $payment)
                                    <tr>
                                        <td>{{get_month($payment->month)}}</td>
                                        <td>{{$payment->fee}}</td>
                                        <td>{{$payment->inspected_date}}</td>
                                        <td>
                                            @if($payment->status)
                                                Sudah Dibayar
                                            @else
                                                Belum Dibayar
                                            @endif
                                        </td>
                                    </tr>
                            @endforeach
                        </table>
                        <a href="{{route('siswa.bayar',['id'=>Auth::id()])}}" class="btn btn-success float-right">Bayar SPP</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<?php
function get_month($m){
    switch ($m){
        case 1 :
            return "Januari";
        case 2 :
            return "Febuari";
        case 3 :
            return "Maret";
        case 4 :
            return "April";
        case 5 :
            return "Mei";
        case 6 :
            return "Juni";
        case 7 :
            return "Juli";
        case 8 :
            return "Agustus";
        case 9 :
            return "September";
        case 10 :
            return "Oktober";
        case 11 :
            return "November";
        case 12 :
            return "Desember";
        default :
            return "Kode Bulan tidak valid";
    }
}
?>