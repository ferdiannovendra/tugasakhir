<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Semester;
use App\Models\User;
use App\Models\DetailSiswa;
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
            ->where('siswa_di_kelas.users_idusers',$iduser)
            ->first();

            $data = DB::table('jadwal_kelas')
            ->join('hari','hari_id','id')
            ->join('mata_pelajaran','idmatapelajaran','idmata_pelajaran')
            ->where('idclass_list',$kelas->idclass_list)
            ->orderBy('hari_id', 'asc')
            ->orderBy('jam_mulai','asc')->get();

            $count = DB::table('jadwal_kelas')->join('mata_pelajaran','idmatapelajaran','idmata_pelajaran')
            ->select('idclass_list','idmatapelajaran')->where('idclass_list',$kelas->idclass_list)->groupBy('idclass_list','idmatapelajaran')->get()->count();
            // dd($count);
            return view('sekolah.siswa.index',compact('count','data','kelas','cekSemester'));
        }else{
            return view('sekolah.siswa.pending');
        }
    }
    public function profil()
    {
        $iduser = Auth::user()->id;
        $data = User::find($iduser);
        $detail = DetailSiswa::where('idusers',$iduser)->first();
        // dd($data);
        return view('sekolah.siswa.profile.index',compact('data','detail'));
    }
}
