<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alldata =  DB::table('jurusan')->get();

        return view('sekolah.admin.daftarjurusan',["data"=>$alldata]);
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
        $insertData = DB::table('jurusan')->insert([
                        'nama_jurusan' => $request->nama_jurusan,
                        'description' => $request->description
                    ]);

        if ($insertData) {
            return redirect()->route('daftarjurusan')
            ->with('status','Jurusan baru berhasil ditambahkan!');
        }else{
            return redirect()->route('daftarjurusan')
            ->with('error','Jurusan baru gagal ditambahkan!');
        }

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
    public function edit($id)
    {
        //
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
        $idjurusan = $request->idjurusan;
        $delete = DB::table('jurusan')->where('idjurusan', $idjurusan)->delete();

        if ($delete) {
            return redirect()->route('daftarjurusan')
            ->with('status','Jurusan berhasil dihapus!');
        }else{
            return redirect()->route('daftarjurusan')
            ->with('error','Jurusan gagal dihapus!');
        }

    }
}
