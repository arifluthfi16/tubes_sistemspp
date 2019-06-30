<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Users;
use App\Profile;

class SPPController extends Controller
{
    public function bayarForm(){
        //Ambil id user
        $id = Auth::id();
        //Ambil yang mana saja yang sudah dibayar
        $payment_info = DB::table('user_payment_info')->where('user_id',$id)->get();
        //Ambil setiap bulan yang ada di tagihan
        $months = $this->getMonths(Auth::id());


        //Fetch data tagihan buat header
        $tagihans = DB::table('tagihan')
            ->where('user_id',Auth::id())->get()
            ->where('status',0);
        
        $users_name = DB::table('users')
            ->where('id', $id)->get();

        $users_profile = DB::table('user_profile')
            ->join('users', 'user_profile.user_id', 'users.id')
            ->where('user_profile.user_id', Auth::id())
            ->get();

        return view('siswa.bayar')
             ->with('users_name', $users_name)
            ->with('users_profile', $users_profile)
            ->with('payment_info',$payment_info)
            ->with('tagihans', $tagihans)
            ->with('month_info',$months);


    }

    public function bayarProses(Request $request){

        //Ambil next id karena kita harus insert ke DB tagihan, karena pakai query builder jadi gak tahu next id nya
        //apa
        $nextId = DB::table('tagihan')->max('id')+1;
        $total = $this->calc_total($request->payment)+$nextId;

        //Membuat tagihan baru
        $db = DB::table('tagihan')
            ->insert([
                "total" => $total,
                "user_id" => Auth::id(),
            ]);

        //Get Latest ID
        $id = DB::table('tagihan')->max('id');
        //Jadi disini kita memasukkan data ke detail_tagihan untuk tagihan  diatas yang baru dibuat
        foreach ($request->payment as $py){
            DB::table('detail_tagihan')
                ->insert([
                    'id_tagihan' => $id,
                    'month' => $py
            ]);
        }




        return redirect()->route('siswa.cek_tagihan',['id_tagihan'=>$id]);
    }

    public function cekTagihan($id_tagihan){
        //Ambil daftar bulan tagihan

        $months = $this->getMonthsIn($id_tagihan);

        //Ambil  data tagihan nominal
        $data_tagihan = DB::table('tagihan')
            -> where('id',$id_tagihan)
            -> where('user_id',Auth::id())
            -> first();

        //Data Untuk Header
        $tagihans = DB::table('tagihan')
            ->where('user_id',Auth::id())->get()
            ;

        $users_name = DB::table('users')
            ->where('id', Auth::id())->get();

        $users_profile = DB::table('user_profile')
            ->join('users', 'user_profile.user_id', 'users.id')
            ->where('user_profile.user_id', Auth::id())
            ->get();

        $detail_tagihan = DB::table('tagihan')
        ->join('user_payment_info','tagihan.user_id','user_payment_info.user_id')
        ->where('tagihan.user_id',Auth::id())
        ->where('tagihan.id',$id_tagihan)
        ->wherein('month',$months)
        ->get();

        return view('siswa.tagihan')
            ->with('users_name', $users_name)
            ->with('users_profile', $users_profile)
            ->with('data_tagihan',$data_tagihan)
            ->with('tagihans', $tagihans)
            ->with('detail_tagihan',$detail_tagihan);

    }

    public function siswaIndex(){
        $id = Auth::id();
        $payments_info = DB::table('user_payment_info')
            ->where('user_id',$id)->get();

        $tagihans = DB::table('tagihan')
            ->where('user_id',$id)->get()
            ->where('status',0);        
        
        $users_name = DB::table('users')
            ->where('id', $id)->get();

        $users_profile = DB::table('user_profile')
            ->join('users', 'user_profile.user_id', 'users.id')
            ->where('user_profile.user_id', Auth::id())
            ->get();

            return view('siswa.index') 
            ->with('users_name', $users_name)
            ->with('users_profile', $users_profile)
            ->with('payments_info',$payments_info)
            ->with('tagihans', $tagihans);
    }

    //Utility Function
    private function calc_total(Array $months){
        $total = 0;
        foreach($months as $month){
            $fee = DB::table('user_payment_info')
                ->where('user_id', Auth::id())
                ->where('month',$month)
                ->first();

            $total += $fee->fee;
        }
        return $total;
    }

    //Fungsi ini akan mengembalikkan setiap bulan yang ada pada tagihan siswa
    public function getMonths($id){
        $tagihans = DB::table('tagihan')
        ->where('user_id',$id)
        ->where('status',0)
        ->get();

        $outs = [];
        $detail_tagihan_array = [];
        if(sizeof($tagihans) > 0){
            foreach ($tagihans as $tagihan){
                array_push($outs,$tagihan->id);
            }

            foreach ($outs as $out){
                $hans = DB::table('detail_tagihan')
                    ->select('month')
                    ->where('id_tagihan',$out)
                    ->get();
                foreach ($hans as $han){
                    array_push($detail_tagihan_array,$han->month);
                }
            }


        }
        return $detail_tagihan_array;
    }

    public function getMonthsIn($id_tagihan){
        $tagihans = DB::table('detail_tagihan')
            ->select('month')
            ->where('id_tagihan',$id_tagihan)
            ->get();

        $out = [];
        foreach ($tagihans as $tagihan){
            array_push($out,$tagihan->month);
        }

        return $out;
    }

    public function cancelTagihan($id_tagihan){
        DB::table('detail_tagihan')
            ->where('id_tagihan',$id_tagihan)
            ->delete();

        DB::table('tagihan')
            ->delete($id_tagihan);

        return redirect()->route('siswa.index');
    }

    public function myProfile()
    {
        $id = Auth::id();
        $payments_info = DB::table('user_payment_info')
            ->where('user_id',$id)->get();

        $tagihans = DB::table('tagihan')
            ->where('user_id',$id)->get()
            ->where('status',0);        
        
        //untuk header
        $users_name = DB::table('users')
            ->where('id', $id)->get();

        $users_profile = DB::table('user_profile')
            ->join('users', 'user_profile.user_id', 'users.id')
            ->where('user_profile.user_id', Auth::id())
            ->get();
        
        return view('siswa.profile.index')
            ->with('users_name', $users_name)
            ->with('users_profile', $users_profile)
            ->with('payments_info',$payments_info)
            ->with('tagihans', $tagihans);
    }

    public function edit($id)
    {
        $siswa = \App\Users::find($id);
        
        //for header
        $users_name = DB::table('users')
            ->where('id', $id)->get();

        $users_profile = DB::table('user_profile')
            ->join('users', 'user_profile.user_id', 'users.id')
            ->where('user_profile.user_id', Auth::id())
            ->get();
        
        $tagihans = DB::table('tagihan')
            ->where('user_id',$id)->get()
            ->where('status',0);  

        return view('siswa.profile.index', ['siswa' => $siswa]) 
        ->with('users_name', $users_name)
        ->with('users_profile', $users_profile)
        ->with('tagihans', $tagihans);
    }

    public function update(Request $request, $id)
    {
        //validasi jika ada error ketika mengedit data
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'Orangtua_wali' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        //for user
        $siswa = \App\Users::find($id);

        DB::table('users')
            ->where('id', $siswa->id)
            ->update([
                'name' => $request->name
            ]);

        DB::table('user_profile')
        ->where('user_profile.user_id', $siswa->id)
        ->update([
            'address' => $request->address,
            'Orangtua_wali' => $request->Orangtua_wali
        ]);

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalName();
            $file->move(\base_path() ."/public/userimage", $extension);
            $save = DB::table('user_profile')
            ->where('user_profile.user_id', $siswa->id)
            ->update([
                'image' => $extension
            ]);
        }

        return redirect('/siswa/profile')
            ->with('success', 'Data Has Been Updated');
    }

}

