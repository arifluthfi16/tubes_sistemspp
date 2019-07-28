<?php
/**
 * Created by PhpStorm.
 * User: X
 * Date: 7/11/2019
 * Time: 7:05 PM
 */

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TestController
{
    public function yearTest(){
        //Compose Array of Academic Year with 3 Element depend on the year
       $year = "2019";

       $ca = Carbon::parse($year)->year();
       dd($ca);
    }

    public function forceExit(){
        // Initialize the session.
// If you are using session_name("something"), don't forget it now!
        session_start();
// Unset all of the session variables.
        $_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

// Finally, destroy the session.
        session_destroy();
    }

    public function test2(){
      dd($this->checkCurrentYear('2022'));
    }

    public function checkNextYear($year){
        $nextYear = DB::table('tahun')
            ->select('id')
            ->where('start_year',(int)$year+1)
            ->get();

        if(sizeof($nextYear) == 0){
            return false;
        }
        return true;
    }

    public function checkCurrentYear($year){
        $nextYear = DB::table('tahun')
            ->select('id')
            ->where('start_year',$year)
            ->get();

        if(sizeof($nextYear) == 0){
            return false;
        }
        return true;
    }
}