<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hari;

class HariController extends Controller
{
    public function index()
    {
        $data = Hari::all();
        return view('sekolah.admin.hari.daftarhari',compact('data'));
    }
    public function store(Request $request)
    {
        $hari = new Hari();
        $hari->nama = $request->hari;
        $hari->save();
        return redirect()->back()->with('status','Hari baru berhasil ditambahkan!');
    }
    public function update(Request $request, $id)
    {
        $hari = Hari::find($id);
        $hari->nama = $request->hari;
        $hari->save();
        return redirect()->back()->with('status','Hari baru berhasil diubah!');
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $data = Hari::find($id);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('sekolah.admin.hari.edithari',compact('data','id'))->render()
        ),200);
    }
}
