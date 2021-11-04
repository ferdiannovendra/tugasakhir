<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Presensi;

class PresensiController extends Controller
{
    public function index()
    {
        $alldata =  Presensi::all();

        return view('sekolah.admin.daftarpresensi',["data"=>$alldata]);
    }
}
