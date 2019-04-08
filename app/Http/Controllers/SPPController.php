<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SPPController extends Controller
{
    public function bayarForm(){
        $id = Auth::id();
        $payment_info = DB::table('user_payment_info')->where('user_id',$id)->get();

        $tagihans = DB::table('tagihan')
            ->where('user_id',Auth::id())->get();

        return view('siswa.bayar')
            ->with('payment_info',$payment_info)
            ->with('tagihans', $tagihans);
    }

    public function bayarProses(Request $request){

        $nextId = DB::table('tagihan')->max('id')+1;
        $total = $this->calc_total($request->payment)+$nextId;

        $db = DB::table('tagihan')
            ->insert([
                "total" => $total,
                "user_id" => Auth::id(),
            ]);

        foreach ($request->payment as $py){
            DB::table('detail_tagihan')
                ->insert([
                    'id_tagihan' => $nextId,
                    'month' => $py
            ]);
        }


        return redirect()->route('siswa.cek_tagihan',['id_tagihan'=>$nextId]);
    }

    public function cekTagihan($id_tagihan){
        $data_tagihan = DB::table('tagihan')
            -> where('id',$id_tagihan)
            -> where('user_id',Auth::id())
            -> first();

        $tagihans = DB::table('tagihan')
            ->where('user_id',Auth::id())->get();

        return view('siswa.tagihan')
            ->with('data_tagihan',$data_tagihan)
            ->with('tagihans', $tagihans);
    }

    public function siswaIndex(){
        $id = Auth::id();
        $payments_info = DB::table('user_payment_info')
            ->where('user_id',$id)->get();

        $tagihans = DB::table('tagihan')
            ->where('user_id',$id)->get();

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
}

