<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\JenisPembayaran;
use App\Models\Kelas;
use App\Models\Semester;
use App\Models\RekapPembayaran;
use Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        $alldata =  JenisPembayaran::all();

        return view('sekolah.admin.jenispembayaran.daftarjenispembayaran',["data"=>$alldata]);
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
    public function edit(Request $request)
    {
        $id = $request->id;
        $pemb = JenisPembayaran::find($id);

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('sekolah.admin.jenispembayaran.editjenispembayaran',compact('pemb','id'))->render()
        ),200);

    }
    public function update(Request $request, $id)
    {
        $pemb = JenisPembayaran::find($id);
        $pemb->nama_jenis = $request->nama_jenis;
        if ($pemb->save()) {
        return redirect()->route('daftarJenisPembayaran')
        ->with('status','Jenis Pembayaran baru berhasil diubah!');
        }else{
        return redirect()->route('daftarJenisPembayaran')
        ->with('error','Jenis Pembayaran baru gagal diubah!');
        }
    }
    public function daftarrekapkeuangan()
    {
        $data = Kelas::all();
        $jenis = JenisPembayaran::all();
        $semester = Semester::all();

        return view('sekolah.admin.keuangan.index',compact('data','jenis','semester'));
    }
    public function daftarrekapkeuangan_kelas($id)
    {
        $data = array();
        $siswa_di_kelas = DB::table('siswa_di_kelas')->where('classlist_idclass', $id)->get();
        foreach ($siswa_di_kelas as $key => $value) {
            $rekap = DB::table('rekap_keuangan as r')
            ->join('users','users_idusers','id')
            ->join('jenis_pembayaran as j','r.idjenis_pembayaran','j.idjenis_pembayaran')
            ->where('users_idusers', $value->users_idusers)->get();
            for ($i=0; $i < count($rekap); $i++) {
                # code...
                $data[] = $rekap[$i];
            }
        }
        $jenis = JenisPembayaran::all();
        $semester = Semester::all();
        // dd($data);
        return view('sekolah.admin.keuangan.rekapkelas',compact('data','jenis','semester'));
    }
    public function postTambahTagihan(Request $request)
    {
        $siswa_di_kelas = DB::table('siswa_di_kelas')->where('classlist_idclass', $request->kelas)->get();
        foreach ($siswa_di_kelas as $key => $value) {
            $rekap = new RekapPembayaran();
            $rekap->idjenis_pembayaran = $request->jenis;
            $rekap->semester_idsemester = $request->semester;
            $rekap->tenggat_pembayaran = $request->tenggat_pembayaran;
            $rekap->users_idusers = $value->users_idusers;
            $rekap->status_bayar = 'unpaid';
            $rekap->save();
        }
        return redirect()->back()->with('status','Berhasil Menambahkan Tagihan');

    }
    public function postBulkAction(Request $request)
    {
        $now = Carbon::now();

        for ($i=0; $i < count($request->idtagihan); $i++) {
            $rekap = RekapPembayaran::find($request->idtagihan[$i]);
            $rekap->status_bayar = $request->action;
            if ($request->action == 'paid') {
                $rekap->tanggal_pelunasan = $now;
            } else if($request->action == "unpaid") {
                $rekap->tanggal_pelunasan = null;
            } else {
                $rekap->tanggal_pelunasan = null;
            }
            $rekap->save();
        }
        return redirect()->back()->with('status','Berhasil Mengubah Tagihan');
    }

    // ---------------- Buat Siswa ----------------
    public function daftartagihan()
    {
        $data = DB::table('rekap_keuangan as r')
        ->join('users','users_idusers','id')
        ->join('jenis_pembayaran as j','r.idjenis_pembayaran','j.idjenis_pembayaran')
        ->where('users_idusers', Auth::user()->id)->get();
        // dd($data);
        // $data = RekapPembayaran::where('users_idusers', Auth::user()->id)->get();
        return view('sekolah.siswa.keuangan.index', compact('data'));
    }
    public function upload_bukti(Request $request)
    {
        $now = Carbon::now();

        $id = $request->idrekap;
        $data = RekapPembayaran::find($id);
        // dd($request->file('upload_bukti'));
        if (!empty($request->file('upload_bukti'))) {
            $file = $request->file('upload_bukti');
            $new_name = "bukti_".$data->idrekap_keuangan."_".date('YmdHis', strtotime($now))."_".$file->getClientOriginalName();
            $file->move(public_path().'/'.('fileupload/buktibayar/'), $new_name);
            $data->bukti_bayar = $new_name;
            $data->tanggal_pelunasan = $now;
            $data->save();
            return redirect()->back()->with('status','Berhasil Menambahkan bukti bayar');
        } else {
            return redirect()->back()->with('error','Gagal Menambah Tagihan');

        }

    }
}
