<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\JenisPembayaran;

class PembayaranController extends Controller
{
    public function index()
    {
        $alldata =  JenisPembayaran::all();

        return view('sekolah.admin.daftarjenispembayaran',["data"=>$alldata]);
    }
    public function store(Request $request)
    {
        $pemb = new JenisPembayaran();
        $pemb->nama_jenis = $request->nama_jenis;
        if ($pemb->save()) {
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
        $pemb = JenisPembayaran::find($id);

        if ($pemb->delete()) {
            return redirect()->route('daftarJenisPembayaran')
            ->with('status','Jenis Pembayaran berhasil dihapus!');
        }else{
            return redirect()->route('daftarJenisPembayaran')
            ->with('error','Jenis Pembayaran gagal dihapus!');
        }
    }
}
