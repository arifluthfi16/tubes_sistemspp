<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PegawaiController extends Controller
{
    public function index(){
        $tagihans = DB::table('tagihan')
            ->select('*')
            ->where('status',0)
            ->get();

//        return $tagihans;
        return view('pegawai.index')
            ->with('tagihans', $tagihans);
    }

    public function prosesTagihan($id){
        $user_id = DB::table('tagihan')
            ->where('id',$id)
            ->first()->user_id;

        $months = DB::table('detail_tagihan')
            ->where('id_tagihan',$id)
            ->get();

        DB::table('tagihan')
            ->where('id',$id)
            ->update([
                'status' => 1,
                'inspected_date' => Carbon::now()
            ]);

        foreach($months as $month){
            DB::table('user_payment_info')
                ->where('user_id',$user_id)
                ->where('month',$month->month)
                ->update([
                   'status' =>1,
                   'inspected_date' =>Carbon::now()
                ]);
        }


    }
}
