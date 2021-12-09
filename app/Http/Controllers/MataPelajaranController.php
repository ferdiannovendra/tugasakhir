<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\MataPelajaran;
use App\Models\KategoriMapel;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $alldata = MataPelajaran::all();
        $dataKategori = KategoriMapel::all();
        $dataGuru = DB::table('users')->where('status','guru')->get();
        return view('sekolah.admin.matapelajaran.daftarmatapelajaran',["kategori"=>$dataKategori,"data"=>$alldata, "dataGuru"=>$dataGuru]);
    }
    public function store(Request $request)
    {
        $mp = new MataPelajaran();
        $mp->nama_mp = $request->nama_mp;
        $mp->status = "Aktif";
        $mp->skm = $request->skm;
        $mp->guru_pengajar = $request->pengajar;

        if ($mp->save()) {
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
        $mp = MataPelajaran::find($idmata_pelajaran);

        if ($mp->delete()) {
            return redirect()->route('daftarmatapelajaran')
            ->with('status','Mata Pelajaran berhasil dihapus!');
        }else{
            return redirect()->route('daftarmatapelajaran')
            ->with('error','Mata Pelajaran gagal dihapus!');
        }
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $mp = MataPelajaran::find($id);
        $kategori = KategoriMapel::all();
        $dataGuru = DB::table('users')->where('status','guru')->get();

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('sekolah.admin.matapelajaran.editmatapelajaran',compact('mp','id','dataGuru','kategori'))->render()
        ),200);

    }
    public function update(Request $request, $id)
    {
        $mp = MataPelajaran::find($id);
        $mp->nama_mp = $request->nama_mp;
        $mp->status = "Aktif";
        $mp->guru_pengajar = $request->pengajar;
        $mp->skm = $request->skm;

        if ($mp->save()) {
        return redirect()->route('daftarmatapelajaran')
        ->with('status','Mata Pelajaran baru berhasil diubah!');
        }else{
        return redirect()->route('daftarmatapelajaran')
        ->with('error','Mata Pelajaran baru gagal diubah!');
        }
    }


}
