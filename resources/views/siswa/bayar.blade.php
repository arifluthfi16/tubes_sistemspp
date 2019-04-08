@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('siswa/includes/header')
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <b>Pembayaran</b>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Pilih SPP yang akan Dibayar</h5>
                        <form action="{{route('siswa.proses')}}" method="post">
                            {{csrf_field()}}

                            <table class="table table-bordered">
                                <thead>
                                    <th>Bulan</th>
                                    <th>Biaya</th>
                                    <th>Status</th>
                                    <th>Pilihan</th>
                                </thead>

                                    @foreach($payment_info as $payment)
                                    <tr>
                                        <td>{{get_month($payment->month)}}</td>
                                        <td>{{$payment->fee}}</td>
                                        <td>
                                            @if(!$payment->status)
                                                Belum Dibayar
                                            @else
                                                Sudah Dibayar
                                            @endif
                                        </td>
                                        <td>
                                            @if(!$payment->status)
                                                <input type="checkbox" name="payment[]" value="{{$payment->month}}">
                                            @else

                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach

                            </table>
                            <a href="{{route('siswa.index')}}" class="btn btn-danger">Batalkan</a>
                            <input type="submit" class="btn btn-success float-right" value="Bayar">
                        </form>
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
            return "Kode Bulab tidak valid";
    }
}
?>