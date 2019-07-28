<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Array_;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
//    protected $redirectTo = '/home';
    protected function redirectTo(){
        if(Auth::check() && Auth::user()->role == 'admin'){
            return '/admin/home';
        }elseif (Auth::check() && Auth::user()->role == 'pegawai'){
            return '/pegawai/home';
        }elseif (Auth::check() && Auth::user()->role == 'siswa'){
            return '/siswa/home/';
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required','string','in:pegawai,siswa,admin']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
            $role = $data['role'];

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => $role
            ]);

            if($role == 'siswa'){
                //Compose Array of Academic Year with 3 Element depend on the year
                $currentYear = Carbon::now()->year;
                $yearArr = [];
                $yearArr[0] = $currentYear;
                $yearArr[1] = $currentYear+1;
                $yearArr[2] = $currentYear+2;

            // Get Current and 3 Years Next
            DB::table('user_profile')
                ->insert([

                ]);

                foreach ($yearArr as $year ) {
                    $acYearId = DB::table('tahun')
                        ->select('id')
                        ->where('start_year',$year)->get();

                    for($i = 1; $i<=12;$i++){
                        DB::table('user_payment_info')->insert([
                            'user_id' => $user->id,
                            'academic_year_id' => $acYearId[0]->id,
                            'month' => $i,
                            'status' => 0
                        ]);
                    }
                }
            }



        return $user;
    }

    public function getNextThree(){
        $currentYear = Carbon::now()->year;
        $yearArr = [];
        $yearArr[0] = $currentYear;
        $yearArr[1] = $currentYear+1;
        $yearArr[2] = $currentYear+2;
        return $yearArr;
    }
}
