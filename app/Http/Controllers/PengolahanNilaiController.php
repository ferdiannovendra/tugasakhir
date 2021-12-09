<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataPelajaran;

class PengolahanNilaiController extends Controller
{
    public function index_pengetahuan()
    {
        $data = MataPelajaran::all();
        return view('sekolah.admin.pengolahan_nilai.index-pengetahuan',compact('data'));
    }
    public function index_keterampilan()
    {
        $data = MataPelajaran::all();
        return view('sekolah.admin.pengolahan_nilai.index-keterampilan',compact('data'));
    }
}
