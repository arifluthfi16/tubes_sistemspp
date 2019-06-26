<?php
/**
 * Created by PhpStorm.
 * User: X
 * Date: 6/20/2019
 * Time: 10:33 PM
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController
{
    public function index(){
        return view('admin.index');
    }

    public function userlist(){
        $user_list = DB::table('users')
            ->where('role','siswa');

        return view('admin.userlist')
            ->with('user_list',$user_list);
    }
}