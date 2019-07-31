<?php


?>

@extends('layouts.app')
<html>
    <head>
        <title>Cetak PDF Tagihan</title>
    </head>

    <body>
        <div class="container">
            <br>
            <center>
                <h4>Laporan Tagihan</h4>
            </center>
            <br/>
            <table class="table table-bordered">
                <tr>
                    <td>ID Tagihan</td>
                    <td>Nama User</td>
                    <td>Total</td>
                    <td>Status</td>
                    <td>Tahun Ajaran</td>
                </tr>

                @foreach($tagihan as $data)
                    <?php
                    $status = $data->status == 1 ? "Sudah Dibayar" : "Belum Dibayar";
                    ?>
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->total}}</td>
                        <td>{{$status}}</td>
                        <td>{{$data->academic_year_id}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </body>
</html>
