<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriMapel;

class KategoriMapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = KategoriMapel::all();
        return view('sekolah.admin.matapelajaran.daftarkategori',compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kat = new KategoriMapel();
        $kat->nama_kategori = $request->nama;
        $kat->save();
        return redirect()->back()->with('status','Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $kategori = KategoriMapel::find($id);

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('sekolah.admin.matapelajaran.editkategori',compact('kategori','id'))->render()
        ),200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $kat = KategoriMapel::find($request->idkat);
        $kat->delete();
        return redirect()->back()->with('status','Berhasil dihapus');
    }
}
