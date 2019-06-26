<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        return view('siswa.bayar')
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

        $detail_tagihan = DB::table('tagihan')
        ->join('user_payment_info','tagihan.user_id','user_payment_info.user_id')
        ->where('tagihan.user_id',Auth::id())
        ->where('tagihan.id',$id_tagihan)
        ->wherein('month',$months)
        ->get();

        return view('siswa.tagihan')
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

        return view('siswa.index')
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



}

