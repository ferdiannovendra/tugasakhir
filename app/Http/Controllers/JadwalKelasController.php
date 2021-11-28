<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\Hari;

class JadwalKelasController extends Controller
{
    public function index()
    {
        $dataMP = MataPelajaran::all();
        $kelas = Kelas::all();
        $hari = Hari::all();
        $data = DB::table('jadwal_kelas')
        ->join('class_list','jadwal_kelas.idclass_list','=','class_list.idclass_list')
        ->join('mata_pelajaran','idmatapelajaran','=','idmata_pelajaran')
        ->join('hari','hari_id','=','id')
        ->get();
        return view('sekolah.admin.jadwal.daftarjadwal',compact('data','dataMP','kelas','hari'));
    }
    public function store(Request $request)
    {
        $insert = DB::table('jadwal_kelas')->insert([
            'idclass_list' => $request->kelas,
            'idmatapelajaran' => $request->matapelajaran,
            'hari_id' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_akhir' => $request->jam_akhir
        ]);
        if ($insert) {
            return redirect()->back()->with('status','Jadwal berhasil ditambahkan');
        }else{
            return redirect()->back()->with('error','Jadwal gagal ditambahkan');
        }
    }
    public function ubahjadwal(Request $request)
    {
        $data = DB::table('jadwal_kelas')->where('idclass_list',$request->id)
        ->where('idmatapelajaran',$request->idmp)->where('hari_id',$request->idhari)->get();
        return view('sekolah.admin.jadwal.editjadwal',compact('data'));
    }
}
