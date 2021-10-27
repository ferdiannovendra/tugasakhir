<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MataPelajaranController extends Controller
{
    public function index()
    {
        // $alldata =  DB::table('mata_pelajaran')->select('idmata_pelajaran','nama_mp','mata_pelajaran.status','mata_pelajaran.name' )->join('users', 'mata_pelajaran.guru_pengajar', '=', 'users.id')->get();
        $alldata = DB::select("SELECT m.idmata_pelajaran, m.nama_mp, m.status, u.name, m.created_at, m.updated_at from mata_pelajaran m inner join users u on m.guru_pengajar=u.id");
        $dataGuru = DB::table('users')->where('status','guru')->get();
        return view('sekolah.admin.daftarmatapelajaran',["data"=>$alldata,"dataGuru"=>$dataGuru]);
    }
    public function store(Request $request)
    {
        $now =  Carbon::now();
        $insertData = DB::table('mata_pelajaran')->insert([
            'nama_mp' => $request->nama_mp,
            'status' => "Aktif",
            'guru_pengajar' => $request->pengajar,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        if ($insertData) {
        return redirect()->route('daftarmatapelajaran')
        ->with('status','Mata Pelajaran baru berhasil ditambahkan!');
        }else{
        return redirect()->route('daftarmatapelajaran')
        ->with('error','Mata Pelajaran baru gagal ditambahkan!');
        }
    }
    public function destroy(Request $request)
    {
        $idmata_pelajaran = $request->idmata_pelajaran;
        $delete = DB::table('mata_pelajaran')->where('idmata_pelajaran', $idmata_pelajaran)->delete();

        if ($delete) {
            return redirect()->route('daftarmatapelajaran')
            ->with('status','Mata Pelajaran berhasil dihapus!');
        }else{
            return redirect()->route('daftarmatapelajaran')
            ->with('error','Mata Pelajaran gagal dihapus!');
        }
    }
}
