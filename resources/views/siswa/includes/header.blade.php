<div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            Dashboard Siswa
        </div>
        <div class="card-body">
            <p class="text-center">
            @foreach($users_profile as $user_profile) 
                <img class="img-fluid img-round" src="{{asset('userimage/'.$user_profile->image)}}" alt="...">
            @endforeach
            </p>
            <br>
            <table class="table">
                <tr>
                    <td>
                        Nama
                    </td>
                    <td>
                        @foreach($users_name as $users)
                        {{$users->name}}
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>
                        NIS
                    </td>
                    <td>@foreach($users_profile as $user_profile)
                        {{$user_profile->nomor_induk}}
                        @endforeach</td>
                </tr>
                <tr>
                    <td width="120px">Tahun Masuk</td>
                    <td>@foreach($users_profile as $user_profile)
                        {{$user_profile->tahun_masuk}}
                        @endforeach</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>@foreach($users_profile as $user_profile)
                        {{$user_profile->address}}
                        @endforeach</td>
                </tr>
                <tr>
                    <td>Nama Orang Tua/Wali</td>
                    <td>@foreach($users_profile as $user_profile)
                        {{$user_profile->Orangtua_wali}}
                        @endforeach</td>
                </tr>
            </table>
            <hr>
            <p class="text-center"><a href="{{Route('siswa.edit', ['id' => $users->id])}}" class="btn btn-primary mt-2">Edit Profile</a></p>
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