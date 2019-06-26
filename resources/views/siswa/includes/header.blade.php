<div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            Dashboard Siswa
        </div>
        <div class="card-body">
            <p class="text-center"><img class="img-fluid img-round" src="{{asset('userimage/user.jpg')}}"></p>
            <br>
            <table class="table">
                <tr>
                    <td>
                        Nama
                    </td>
                    <td>
                        Arif
                    </td>
                </tr>
                <tr>
                    <td>
                        NIS
                    </td>
                    <td>10117009</td>
                </tr>
                <tr>
                    <td width="120px">Tahun Masuk</td>
                    <td>2019</td>
                </tr>
            </table>
        </div>
    </div>
    <br>
    @if(count($tagihans) !== 0)
        <div class="card">
            <div class="card-header">
                Daftar Tagihan Anda
            </div>
            <table class="table text-center">

                <thead>
                <th>Nomor Tagihan</th>
                <th>Total</th>
                <th>Cek tagihan</th>
                </thead>

                @foreach($tagihans as $tagihan)
                    @if(!$tagihan->status)
                        <tr>
                            <td>{{$tagihan->id}}</td>
                            <td>Rp{{($tagihan->total)}}</td>
                            <td><a href="{{route('siswa.cek_tagihan',['id_tagihan'=>$tagihan->id])}}" class="btn btn-primary">Detail</a></td>
                        </tr>
                    @endif
                @endforeach

            </table>
        </div>
    @endif
    <br>
</div>