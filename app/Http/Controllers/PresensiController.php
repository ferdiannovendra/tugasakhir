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
        $dataMP = MataPelajaran::all();
        return view('sekolah.admin.presensi.daftarpresensi',["data"=>$alldata, "dataMP"=>$dataMP]);
    }
    public function showpresensimp($id)
    {
        $idmp = $id;
        if ($id == 0) {
            $data = Presensi::all();
        }
        $data = Presensi::where("idmatapelajaran", $id)->get();
        $dataMP = MataPelajaran::all();

        return view('sekolah.admin.presensi.daftarpresensi',["data"=>$data,"dataMP"=>$dataMP, "id"=>$idmp]);
    }
    public function store(Request $request)
    {
        $alldata =  Presensi::all();
        $dataMP = MataPelajaran::all();
        return view('sekolah.admin.presensi.daftarpresensi',["data"=>$alldata, "dataMP"=>$dataMP]);
    }

    //--------------- BUAT GURU --------------------
    public function guru_listpresensi()
    {
        $idpengajar = Auth::user()->id;
        $data = Presensi::where('idpengajar', $idpengajar)->get();
        $mata_pelajaran = MataPelajaran::where('guru_pengajar',$idpengajar)->get();
        $kelas = $DB::table('siswa_di_kelas')->where();
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
        $presensi->idmatapelajaran = $request->matapelajaran;
        $presensi->start_time = $request->start_time;
        $presensi->end_time = $request->end_time;
        $presensi->catatan_pertemuan = $request->catatan;
        $presensi->save();
        return redirect()->back();
    }
}
