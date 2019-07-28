@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            @include('siswa/includes/header')
            <div class="col-lg-8">
                <div class="card ">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs pull-right"  id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#tab{{$payments_info[0][0]->academic_year_id}}" onclick="show(this)">Tahun Ajaran {{$payments_info[0][0]->academic_year}}</a>
                                </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab{{$payments_info[1][0]->academic_year_id}}" onclick="show(this)" >Tahun Ajaran {{$payments_info[1][0]->academic_year}}</a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#tab{{$payments_info[2][0]->academic_year_id}}" onclick="show(this)">Tahun Ajaran {{$payments_info[2][0]->academic_year}}</a>
                            </li>
                        </ul>
                    </div>
                    {{-- Semua Content SPP Disini--}}
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            @foreach($payments_info as $pyinfo)
                                <div class="tab-pane fade show active" id="tab{{$pyinfo[0]->academic_year_id}}" role="tabpanel" aria-labelledby="home-tab">
                                    {{-- Content SPP Tahun Pertama --}}
                                    <div class="card"   >
                                        <div class="card-header">
                                            Kondisi Keuangan
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Laporan Keuangan Siswa Tahun Ajaran {{$pyinfo[0]->academic_year}}</h5>
                                            <table class="table table-bordered">
                                                <thead>
                                                <th>Bulan ke</th>
                                                <th>Biaya</th>
                                                <th>Tanggal Pembayaran</th>
                                                <th>Status</th>
                                                </thead>
                                                @foreach($pyinfo as $payment)
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
                                            <a href="{{route('siswa.bayar',['ac_id'=>$pyinfo[0]->academic_year_id])}}" class="btn btn-success float-right">Bayar SPP</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach



                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    <script>
        window.onload = ()=>{
            @for($i=1;$i<3;$i++)
                document.getElementById("tab{{$payments_info[$i][0]->academic_year_id}}").hidden = 1;
            @endfor
        }

        function show(event){
            document.getElementById(event.getAttribute('href').substring(1)).hidden = false;
        }
    </script>
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