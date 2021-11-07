<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KompetensiDasar;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\MataPelajaran;

class KompetensiDasarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = KompetensiDasar::all();
        $dataMP = MataPelajaran::all();
        $dataGuru = DB::table('users')->where('status','guru')->get();

        return view('sekolah.admin.daftarkompetensidasar',["data"=>$data,"dataMP"=>$dataMP,"dataGuru"=>$dataGuru]);
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
        //
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
    public function destroy($id)
    {
        //
    }

    public function showkdmp($id)
    {
        $data = KompetensiDasar::where("idkompetensi_dasar", $id)->get();
        $dataMP = MataPelajaran::all();
        $dataGuru = DB::table('users')->where('status','guru')->get();

        return view('sekolah.admin.daftarkompetensidasar',["data"=>$data,"dataMP"=>$dataMP,"dataGuru"=>$dataGuru]);

    }
}
