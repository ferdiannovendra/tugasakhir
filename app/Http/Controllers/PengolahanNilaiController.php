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
        if (Auth::user()->status == "admin") {
            $dataMP = MataPelajaran::all();
        }else{
            $dataMP = MataPelajaran::where('guru_pengajar', Auth::user()->id)->get();
        }
        return view('sekolah.admin.pengolahan_nilai.index-pengetahuan',compact('dataMP'));
    }
    public function lihat_rincian_pengetahuan(Request $request)
    {
        $kelas = 0;
        $mp = 0;

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
            'msg'=>view('sekolah.admin.pengolahan_nilai.data-rincian',compact('data', 'counter','nilai_siswa','kelas','mp'))->render()
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
            'msg'=>view('sekolah.admin.pengolahan_nilai.data-rincian',compact('data', 'counter','nilai_siswa','kelas','mp'))->render()
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
            foreach ($d->penilaian()->where('idclass', $kelas)->where('idmata_pelajaran', $mp)->get() as $p) {
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
            'msg'=>view('sekolah.admin.pengolahan_nilai.data-rapor',compact('data', 'counter','nilai_siswa','kelas','mp'))->render()
        ),200);
    }

    public function lihat_rapor_keterampilan(Request $request)
    {
        $kelas = $request->idclass;
        $mp = $request->idmp;
        $data = KompetensiDasar::whereHas('penilaian',function($q) use($mp,$kelas) {
            $q->where('idmata_pelajaran',$mp)->where('idclass', $kelas)->where('jenispenilaian', "Keterampilan");
        })->get();

        $counter = 0;
        foreach ($data as $d) {
            foreach ($d->penilaian()->where('idclass', $kelas)->where('idmata_pelajaran', $mp)->get() as $p) {
                $counter++;
            }
        }

        $siswa = User::whereHas('kelas', function($q) use($kelas){
            $q->where('classlist_idclass',$kelas);
        })->get();
        $nilai_siswa = array();
        foreach ($siswa as $s) {
            $temp = DB::table('nilai_per_penilaian')->join('penilaian', 'penilaian.idpenilaian', '=', 'nilai_per_penilaian.penilaian_idpenilaian')->join('class_list', 'class_list.idclass_list', '=', 'penilaian.idclass')->where('class_list.idclass_list', $kelas)->where('nilai_per_penilaian.users_idusers', $s->id)->where('penilaian.idmata_pelajaran', $mp)->where('penilaian.jenispenilaian', 'Keterampilan')->orderBy('idkompetensi_dasar','asc')->get();
            // dd($temp);
            $nilai_siswa[] = [$s, $temp];
        }
        // dd($data);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('sekolah.admin.pengolahan_nilai.data-rapor-keterampilan',compact('data', 'counter','nilai_siswa','kelas','mp'))->render()
        ),200);
    }

    // ============= BUAT LIHAT NILAI AKHIR =======================

    public function kirimnilai_pengetahuan(Request $request)
    {
        // dd($request);
        $dataMP = MataPelajaran::all();
        if (Auth::user()->status == "admin") {
            $dataMP = MataPelajaran::all();
        }else{
            $dataMP = MataPelajaran::where('guru_pengajar', Auth::user()->id)->get();
        }
        for ($i=0; $i < count($request->idsiswa); $i++) {
            # code...
            $insert = DB::table('nilai_akhir')->upsert([
                ['idmata_pelajaran' => $request->matapelajaran,'users_id'=>$request->idsiswa[$i], 'nilai_pengetahuan' => $request->nilai[$i]],
            ], ['idmata_pelajaran', 'users_id'], ['nilai_pengetahuan']);
        }

        return view('sekolah.admin.nilai-akhir.index',compact('dataMP'));
    }

    public function kirimnilai_keterampilan(Request $request)
    {
        // dd($request);
        $dataMP = MataPelajaran::all();
        if (Auth::user()->status == "admin") {
            $dataMP = MataPelajaran::all();
        }else{
            $dataMP = MataPelajaran::where('guru_pengajar', Auth::user()->id)->get();
        }
        for ($i=0; $i < count($request->idsiswa); $i++) {
            # code...
            $insert = DB::table('nilai_akhir')->upsert([
                ['idmata_pelajaran' => $request->matapelajaran,'users_id'=>$request->idsiswa[$i], 'nilai_keterampilan' => $request->nilai[$i]],
            ], ['idmata_pelajaran', 'users_id'], ['nilai_keterampilan']);
        }

        return view('sekolah.admin.nilai-akhir.index',compact('dataMP'));
    }

    public function lihatnilaiakhir()
    {
        $dataMP = MataPelajaran::all();
        if (Auth::user()->status == "admin") {
            $dataMP = MataPelajaran::all();
        }else{
            $dataMP = MataPelajaran::where('guru_pengajar', Auth::user()->id)->get();
        }
        return view('sekolah.admin.nilai-akhir.index',compact('dataMP'));
    }
    public function nilai_akhir(Request $request)
    {
        $kelas = $request->idclass;
        $mp = $request->idmp;
        $data = DB::table('nilai_akhir')->join('mata_pelajaran','nilai_akhir.idmata_pelajaran','mata_pelajaran.idmata_pelajaran')->join('users','users_id','id')->where('nilai_akhir.idmata_pelajaran',$mp)->get();

        $siswa = User::whereHas('kelas', function($q) use($kelas){
            $q->where('classlist_idclass',$kelas);
        })->get();
        $nilai_siswa = array();
        // dd($siswa);
        // $count = 0;
        foreach ($siswa as $s) {
            $da = DB::table('nilai_akhir')->join('mata_pelajaran','nilai_akhir.idmata_pelajaran','mata_pelajaran.idmata_pelajaran')->join('users','users_id','id')->where('nilai_akhir.idmata_pelajaran',$mp)->where('nilai_akhir.users_id',$s->id)->first();
            // dd($da);
            $nilai_siswa[] = [$da];
        }

        // dd($nilai_siswa);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('sekolah.admin.nilai-akhir.data-nilaiakhir',compact('data','nilai_siswa','kelas','mp'))->render()
        ),200);
    }
}
