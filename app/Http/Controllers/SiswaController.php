<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DetailSiswa;
use App\Models\Jurusan;
class SiswaController extends Controller
{
    public function getdetailsiswa(Request $request)
    {
        $idsiswa = $request->id;
        $siswa = User::where('status','siswa')->where('id', $idsiswa)->first();
        $detailsiswa = DetailSiswa::where('idusers', $idsiswa)->first();
        $jurusan = Jurusan::find($detailsiswa->jurusan_idjurusan);
        dd($jurusan);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('sekolah.guru.detailsiswa',compact('siswa','detailsiswa','jurusan'))->render()
        ),200);
    }
}
