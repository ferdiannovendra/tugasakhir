<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\DB;
use Auth;

class BobotController extends Controller
{
    public function index()
    {
        $dataMP = MataPelajaran::all();
        if (Auth::user()->status == "admin") {
            $dataMP = MataPelajaran::all();
        }else{
            $dataMP = MataPelajaran::where('guru_pengajar', Auth::user()->id)->get();
        }
        $dataMP = MataPelajaran::all();
        return view('sekolah.admin.bobot.index',compact('dataMP'));
    }
    public function detail_bobot(Request $request)
    {
        $kelas = $request->idclass;
        $mp = $request->idmp;
        $data = MataPelajaran::find($mp)->bobot()->where('bobot_nilai_akhir.idclass_list',$kelas)->first();
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('sekolah.admin.bobot.bobotdata',compact('data'))->render()
        ),200);
    }
    public function input_bobot(Request $request)
    {
        $hasil = $request->b_pengetahuan + $request->b_keterampilan;
        if ($hasil > 100) {
            return redirect()->back()->with('error', "Bobot gagal di tambah, total bobot > 100");
        } else if ($hasil < 100) {
            return redirect()->back()->with('error', "Bobot gagal di tambah, total bobot < 100");
        } else {
            $insert = DB::table('bobot_nilai_akhir')->upsert([
                ['idmata_pelajaran' => $request->matapelajaran,'idclass_list'=>$request->kelas, 'bobot_pengetahuan' => $request->b_pengetahuan, 'bobot_keterampilan' => $request->b_keterampilan],
            ], ['idmata_pelajaran', 'idclass_list'], ['bobot_pengetahuan','bobot_keterampilan']);

            return redirect()->back()->with('status', "Bobot Berhasil di tambah");
        }

    }
}
