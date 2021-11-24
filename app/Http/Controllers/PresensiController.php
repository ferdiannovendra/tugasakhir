<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Presensi;
use App\Models\MataPelajaran;
use Auth;

class PresensiController extends Controller
{
    public function index()
    {
        $alldata =  Presensi::all();

        return view('sekolah.admin.daftarpresensi',["data"=>$alldata]);
    }

    //--------------- BUAT GURU --------------------
    public function guru_listpresensi()
    {
        $idpengajar = Auth::user()->id;
        $data = Presensi::where('idpengajar', $idpengajar)->get();
        $mata_pelajaran = MataPelajaran::where('guru_pengajar',$idpengajar)->get();
        return view('sekolah.guru.presensi.index',compact('data','mata_pelajaran'));
    }
    public function ubahpresensi(Request $request)
    {
        $idpengajar = Auth::user()->id;
        $data = Presensi::where('idpengajar', $idpengajar)->get();
        $mata_pelajaran = MataPelajaran::where('guru_pengajar',$idpengajar)->get();
        return view('sekolah.guru.presensi.index',compact('data','mata_pelajaran'));
    }
    public function postTambahPresensi(Request $request)
    {
        $idpengajar = Auth::user()->id;
        $presensi = new Presensi();
        $presensi->materi = $request->materi;
        $presensi->start_time = $request->start_time;
        $presensi->end_time = $request->end_time;
        $presensi->catatan_pertemuan = $request->catatan;
        return view('sekolah.guru.presensi.index',compact('data','mata_pelajaran'));
    }
}
