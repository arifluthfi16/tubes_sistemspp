@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('siswa/includes/header')
            @include('siswa/includes/utils')
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
                                                @if(in_array($payment->month,$month_info))
                                                Terdaftar di Tagihan
                                                @else
                                                <input type="checkbox" name="payment[]" value="{{$payment->month}}">
                                                @endif
                                            @else

                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach

                            </table>
                            <a href="{{route('siswa.index')}}" class="btn btn-danger">Batalkan</a>
                            <a href="" class="btn btn-success float-right" data-toggle="modal" data-target="#BayarModal">Bayar</a>
                            <!-- <input type="submit" class="btn btn-success float-right" value="Bayar"> -->

                            <!-- Modal -->
            <div class="modal fade" id="BayarModal" tabindex="-1" role="dialog" aria-labelledby="BayarModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="BayarModalLabel">Bayar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- <form action="{{route('siswa.proses')}}" method="post">
                {{csrf_field()}}` -->
                    <div class="modal-body">
                        <div class="form-group">
                            <p>Anda Yakin Ingin Membayar SPP ?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Bayar">
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

