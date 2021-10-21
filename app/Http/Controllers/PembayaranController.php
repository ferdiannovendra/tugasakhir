<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PembayaranController extends Controller
{
    public function index()
    {
        $alldata =  DB::table('jenis_pembayaran')->get();

        return view('sekolah.admin.daftarjenispembayaran',["data"=>$alldata]);
    }
    public function store(Request $request)
    {
        $now = Carbon::now();
        $alldata =  DB::table('jenis_pembayaran')->get();
        $insertData = DB::table('jenis_pembayaran')->insert([
            'nama_jenis' => $request->nama_jenis,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        if ($insertData) {
        return redirect()->route('daftarJenisPembayaran')
        ->with('status','Jenis Pembayaran baru berhasil ditambahkan!');
        }else{
        return redirect()->route('daftarJenisPembayaran')
        ->with('error','Jenis Pembayaran baru gagal ditambahkan!');
        }
    }
    public function destroy(Request $request)
    {
        $id = $request->idjenis;
        $delete = DB::table('jenis_pembayaran')->where('idjenis_pembayaran', $id)->delete();

        if ($delete) {
            return redirect()->route('daftarJenisPembayaran')
            ->with('status','Jenis Pembayaran berhasil dihapus!');
        }else{
            return redirect()->route('daftarJenisPembayaran')
            ->with('error','Jenis Pembayaran gagal dihapus!');
        }
    }
}
