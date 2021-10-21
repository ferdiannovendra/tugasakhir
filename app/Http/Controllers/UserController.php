<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $alldata =  DB::table('users')->get();

        return view('sekolah.admin.daftaruser',["data"=>$alldata]);
    }
    public function daftarguru()
    {
        $alldata =  DB::table('users')->get();

        return view('sekolah.admin.daftarsemester',["data"=>$alldata]);
    }
    public function daftarsiswa()
    {
        $alldata =  DB::table('users')->get();

        return view('sekolah.admin.daftarsemester',["data"=>$alldata]);
    }
}
