<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Semester;
use Auth;
use Illuminate\Support\Facades\DB;

class HomeSiswaSekolahController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $hariIni = date('Y-m-d',strtotime($now));
        $cekSemester = Semester::where('start_date','<=',$hariIni)
        ->where('end_date','>=',$hariIni)
        ->first();

        if(isset($cekSemester)){
            $iduser = Auth::user()->id;
            $kelas = DB::table('siswa_di_kelas')->join('class_list','classlist_idclass','idclass_list')
            ->where('siswa_di_kelas.semester_idsemester',$cekSemester->idsemester)
            ->first();

            $data = DB::table('jadwal_kelas')->join('mata_pelajaran','idmatapelajaran','idmata_pelajaran')
            ->where('idclass_list',$kelas->idclass_list)->get();
            $count = DB::table('jadwal_kelas')->join('mata_pelajaran','idmatapelajaran','idmata_pelajaran')
            ->where('idclass_list',$kelas->idclass_list)->count();
            // dd($data);
            return view('sekolah.siswa.index',compact('count','data','kelas','cekSemester'));
        }else{
            echo "anu";
        }


    }
}
