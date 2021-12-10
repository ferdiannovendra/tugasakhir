<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\Penilaian;
use App\Models\User;
use App\Models\KompetensiDasar;
use App\Models\NilaiPerPenilaian;
use Illuminate\Support\Facades\DB;
use Auth;

class PengolahanNilaiController extends Controller
{
    public function index_pengetahuan()
    {
        $dataMP = MataPelajaran::all();
        return view('sekolah.admin.pengolahan_nilai.index-pengetahuan',compact('dataMP'));
    }
    public function lihat_rincian_pengetahuan(Request $request)
    {
        $kelas = $request->idclass;
        $mp = $request->idmp;
        $data = KompetensiDasar::whereHas('penilaian',function($q) use($mp,$kelas) {
            $q->where('idmata_pelajaran',$mp)->where('idclass', $kelas)->where('jenispenilaian', "Pengetahuan");
        })->get();

        $counter = 0;
        foreach ($data as $d) {
            foreach ($d->penilaian()->get() as $p) {
                $counter++;
            }
        }

        $siswa = User::whereHas('kelas', function($q) use($kelas){
            $q->where('classlist_idclass',$kelas);
        })->get();
        $nilai_siswa = array();
        foreach ($siswa as $s) {
            $temp = DB::table('nilai_per_penilaian')->join('penilaian', 'penilaian.idpenilaian', '=', 'nilai_per_penilaian.penilaian_idpenilaian')->join('class_list', 'class_list.idclass_list', '=', 'penilaian.idclass')->where('class_list.idclass_list', $kelas)->where('nilai_per_penilaian.users_idusers', $s->id)->where('penilaian.idmata_pelajaran', $mp)->where('penilaian.jenispenilaian', 'Pengetahuan')->get();
            $nilai_siswa[] = [$s, $temp];
        }

        // $nilai = DB::table('nilai_per_penilaian')->where('penilaian_idpenilaian',$idpenilaian)->get();
        // dd($data);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('sekolah.admin.pengolahan_nilai.data-rincian',compact('data', 'counter','nilai_siswa'))->render()
        ),200);
    }
    public function lihat_rincian_keterampilan(Request $request)
    {
        $kelas = $request->idclass;
        $mp = $request->idmp;
        $data = KompetensiDasar::whereHas('penilaian',function($q) use($mp,$kelas) {
            $q->where('idmata_pelajaran',$mp)->where('idclass', $kelas)->where('jenispenilaian', "Keterampilan");
        })->get();

        $counter = 0;
        foreach ($data as $d) {
            foreach ($d->penilaian()->get() as $p) {
                $counter++;
            }
        }

        $siswa = User::whereHas('kelas', function($q) use($kelas){
            $q->where('classlist_idclass',$kelas);
        })->get();
        $nilai_siswa = array();
        foreach ($siswa as $s) {
            $temp = DB::table('nilai_per_penilaian')->join('penilaian', 'penilaian.idpenilaian', '=', 'nilai_per_penilaian.penilaian_idpenilaian')->join('class_list', 'class_list.idclass_list', '=', 'penilaian.idclass')->where('class_list.idclass_list', $kelas)->where('nilai_per_penilaian.users_idusers', $s->id)->where('penilaian.idmata_pelajaran', $mp)->where('penilaian.jenispenilaian', 'Keterampilan')->get();
            $nilai_siswa[] = [$s, $temp];
        }

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('sekolah.admin.pengolahan_nilai.data-rincian',compact('data', 'counter','nilai_siswa'))->render()
        ),200);
    }
    public function index_keterampilan()
    {
        $dataMP = MataPelajaran::all();
        if (Auth::user()->status == "admin") {
            $dataMP = MataPelajaran::all();
        }else{
            $dataMP = MataPelajaran::where('guru_pengajar', Auth::user()->id)->get();
        }
        return view('sekolah.admin.pengolahan_nilai.index-keterampilan',compact('dataMP'));
    }

    // =============== BUAT NILAI RAPOR =========================
    public function lihat_rapor_pengetahuan(Request $request)
    {
        $kelas = $request->idclass;
        $mp = $request->idmp;
        $data = KompetensiDasar::whereHas('penilaian',function($q) use($mp,$kelas) {
            $q->where('idmata_pelajaran',$mp)->where('idclass', $kelas)->where('jenispenilaian', "Pengetahuan");
        })->get();

        $counter = 0;
        foreach ($data as $d) {
            foreach ($d->penilaian()->get() as $p) {
                $counter++;
            }
        }

        $siswa = User::whereHas('kelas', function($q) use($kelas){
            $q->where('classlist_idclass',$kelas);
        })->get();
        $nilai_siswa = array();
        foreach ($siswa as $s) {
            $temp = DB::table('nilai_per_penilaian')->join('penilaian', 'penilaian.idpenilaian', '=', 'nilai_per_penilaian.penilaian_idpenilaian')->join('class_list', 'class_list.idclass_list', '=', 'penilaian.idclass')->where('class_list.idclass_list', $kelas)->where('nilai_per_penilaian.users_idusers', $s->id)->where('penilaian.idmata_pelajaran', $mp)->where('penilaian.jenispenilaian', 'Pengetahuan')->get();
            $nilai_siswa[] = [$s, $temp];
        }

        // $nilai = DB::table('nilai_per_penilaian')->where('penilaian_idpenilaian',$idpenilaian)->get();
        // dd($nilai_siswa);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('sekolah.admin.pengolahan_nilai.data-rapor',compact('data', 'counter','nilai_siswa'))->render()
        ),200);
    }
}
