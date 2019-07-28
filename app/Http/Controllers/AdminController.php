<?php
/**
 * Created by PhpStorm.
 * User: X
 * Date: 6/20/2019
 * Time: 10:33 PM
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Users;
use App\Profile;
use App\pegawai;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    //function admin for siswa
    public function userlist(){
        $id = Auth::id();

        $users = DB::table('users')
        ->where('id', $id)->get();
        
        $siswa_data = DB::table('users')
                ->select('*')
                ->where('role', '=', 'siswa')
                ->get();

        $user_siswa = DB::table('user_profile')
                ->join('users', 'user_profile.user_id', 'users.id')
                ->where('user_profile.user_id', Auth::id())
                ->get();

        $users_profile = DB::table('user_profile')
                ->join('users', 'user_profile.user_id', 'users.id')
                ->select('user_profile.*', 'users.name')
                ->get();


        return view('admin.siswa.index')
            ->with('users',$users)
            ->with('user_siswa', $user_siswa)
            ->with('users_profile', $users_profile)
            ->with('siswa_data', $siswa_data);
    }

    public function details($id)
    {
        $siswa = \App\Users::find($id);

        $users_name = DB::table('users')
            ->where('id', $id)->get();
            
        $users_profile = DB::table('user_profile')
            ->join('users', 'user_profile.user_id', 'users.id')
            ->where('user_profile.user_id', $id)
            ->get();

        return view('admin.siswa.edit',['siswa' => $siswa])
        ->with('users_name', $users_name)    
        ->with('users_profile', $users_profile);
    }
    
    public function updateDetails(Request $request, $id)
    {
        //validasi jika ada error ketika mengedit data
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required', 
            'address' => 'required',
            'phone' => 'required', 
            'Orangtua_wali' => 'required',
            'nomor_induk' => 'required', 
            'tahun_masuk' => 'required'
        ]);

         //for user
         $siswa = \App\Users::find($id);

         DB::table('users')
             ->where('id', $siswa->id)
             ->update([
                 'name' => $request->name,
                 'email' => $request->email
             ]);
 
         DB::table('user_profile')
         ->where('user_profile.user_id', $siswa->id)
         ->update([
             'address' => $request->address,
             'phone' => $request->phone,
             'Orangtua_wali' => $request->Orangtua_wali,
             'nomor_induk' => $request->nomor_induk,
             'tahun_masuk' => $request->tahun_masuk
         ]);
 
         return redirect('/admin/siswa')
             ->with('success', 'Data Has Been Updated');
    }

    public function deleteSiswa($id)
    {
        $users = DB::table('users')
            ->where('id', $id)
            ->delete();

        return redirect('admin/siswa/')
            ->with('users', $users)
            ->with('success', 'Data Has Been Deleted!');
    }

    public function addSiswa(Request $request)
    {
        $yearIn = (int)$request->tahun_masuk;
        $add_siswa = DB::table('users')
                ->insert([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role' => $request->role,
                    'password' => Hash::make($request->password)
                ]);

        //get latest Id
        $id = DB::table('users')->max('id');
        $add_description = DB::table('user_profile')
                ->insert([
                    'user_id' => $id,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'gender' => $request->gender,
                    'nomor_induk' => $request->nomor_induk,
                    'Orangtua_wali' => $request->Orangtua_wali,
                    'tahun_masuk' => $request->tahun_masuk
                ]);

        //Compose Array of Academic Year with 3 Element depend on the year
        $currentYear = $yearIn;
        $yearArr = [];
        $yearArr[0] = $currentYear;
        $yearArr[1] = $currentYear+1;
        $yearArr[2] = $currentYear+2;

        foreach ($yearArr as $year){
            if($this->checkCurrentYear($year)){
                continue;
            }else{
                $ac_year_name = ''.$year.'/'.($year+1);

                DB::table('academic_year')
                    ->insert([
                       'academic_year' => $ac_year_name,
                        'fee' => 500000,
                        'start_year' => $year,
                        'end_year' => $year+1
                    ]);
            }
        }


        foreach ($yearArr as $year ) {
            $acYearId = DB::table('academic_year')
                ->select('id')
                ->where('start_year',$year)->get();

            for($i = 1; $i<=12;$i++){
                DB::table('user_payment_info')->insert([
                    'user_id' => $id,
                    'academic_year_id' => $acYearId[0]->id,
                    'month' => $i,
                    'status' => 0
                ]);
            }
        }

                return redirect()->route('admin.siswa.index');
    }

    //function for show data Pegawai
    public function detailsPegawai()
    {
        $id = Auth::id();

        $users_name = DB::table('users')
            ->where('id', $id)->get();
            
        $users_profile = DB::table('pegawai')
            ->join('users', 'pegawai.id', 'users.id')
            ->get();

        return view('admin.pegawai.index')
        ->with('users_name', $users_name)    
        ->with('users_profile', $users_profile);
    }

    public function addPegawai(Request $request)
    {
        $id = Auth::id();
                
        $add_siswa = DB::table('users')
                ->insert([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $request->role
                ]);

        //get latest Id
        $id = DB::table('users')->max('id');
        $add_description = DB::table('pegawai')
                ->insert([
                    'id' => $id,
                    'NIP' => $request->NIP,
                    'address' => $request->address
                ]);

                return redirect()->route('admin.pegawai.index')
                    ->with('success', 'data has been created.');
    }

    //function for details data pegawai and can edit this data.
    public function pegawaiDetails($id)
    {
        $siswa = \App\pegawai::find($id);

        $users_name = DB::table('users')
            ->where('id', $id)->get();
            
        $users_profile = DB::table('pegawai')
            ->join('users', 'pegawai.id', 'users.id')
            ->where('pegawai.id', $id)
            ->get();

        return view('admin.pegawai.edit',['siswa' => $siswa])
        ->with('users_name', $users_name)    
        ->with('users_profile', $users_profile);
    }

    public function updateDetailsPegawai(Request $request, $id)
    {
        //validasi jika ada error ketika mengedit data
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required', 
            'address' => 'required',
            'NIP' => 'required'
        ]);

         //for user
         $siswa = \App\pegawai::find($id);

         DB::table('users')
             ->where('id', $siswa->id)
             ->update([
                 'name' => $request->name,
                 'email' => $request->email
             ]);
 
         DB::table('pegawai')
         ->where('pegawai.id', $siswa->id)
         ->update([
             'address' => $request->address,
             'NIP' => $request->NIP
         ]);
 
         return redirect('/admin/pegawai')
             ->with('success', 'Data Has Been Updated');
    }

    //function for delete data pegawai
    public function deletePegawai($id)
    {
        $users = DB::table('users')
            ->where('id', $id)
            ->delete();

        return redirect('admin/pegawai/')
            ->with('users', $users)
            ->with('success', 'Data Has Been Deleted!');
    }

    // Function to check if the next academic year exists or not
    public function checkNextYear($year){
        $nextYear = DB::table('academic_year')
            ->select('id')
            ->where('start_year',(int)$year+1)
            ->get();

        if(sizeof($nextYear) == 0){
            return false;
        }
        return true;
    }

    public function checkCurrentYear($year){
        $nextYear = DB::table('academic_year')
            ->select('id')
            ->where('start_year',$year)
            ->get();

        if(sizeof($nextYear) == 0){
            return false;
        }
        return true;
    }

//   Tahun CRUD Things

    public function detailsTahun(){
        $detail_year =  DB::table('academic_year')
            ->select('*')
            ->get();

        return view('admin.tahun.index')
            ->with('detail_year',$detail_year);
    }

    public function addTahun(Request $request){
        $intJum = (int)$request->jumlah;

        // Get Latest Year
        $max_id = DB::table('academic_year')
            ->max('id');


        $lastest_year = DB::table('academic_year')
            ->select('start_year')
            ->where('id',$max_id)
            ->get();

        $maxYear = (int)$lastest_year[0]->start_year+1;

        for($i = 0; $i < $intJum;$i++){
            $ac_name = ($maxYear+$i).'/'.($maxYear+$i+1);

            DB::table('academic_year')
                ->insert([
                    'academic_year' => $ac_name,
                    'fee' => $request->harga,
                    'start_year' => $maxYear+$i,
                    'end_year' => $maxYear+1+$i
                ]);
        }

        return redirect(route('admin.tahun.index'));
    }

    public function detailsEditTahun($id){
        $yearData = DB::table('academic_year')
            ->where('id',$id)
            ->first();

        return view('admin.tahun.edit')
            ->with('yearData',$yearData);
    }

    public function updateTahun(Request $request){
        DB::table('academic_year')
            ->where('id',$request->id)
            ->update([
                'fee' => $request->fee
            ])
            ;


        return redirect(route('admin.tahun.index'));
    }


    public function deleteTahun($id){
        DB::table('academic_year')
            ->where('id',$id)
            ->delete();

        return redirect(route('admin.tahun.index'));
    }




}