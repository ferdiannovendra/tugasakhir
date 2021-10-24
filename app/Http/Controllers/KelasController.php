<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alldata =  DB::table('class_list')->get();
        $dataGuru = DB::table('users')->where('status','guru')->get();
        $dataJurusan = DB::table('jurusan')->get();
        $dataSemester = DB::table('semester')->get();
        return view('sekolah.admin.daftarkelas',["data"=>$alldata,
                                                "dataGuru"=>$dataGuru,
                                                "dataJurusan"=>$dataJurusan,
                                                "dataSemester"=>$dataSemester
                                            ]);
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
        $now =  Carbon::now();
        $insertData = DB::table('class_list')->insert([
            'nama_semester' => $request->nama_semester,
            'tahun_ajaran' => $request->tahun_ajaran,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'created_at' => $now
        ]);

        if ($insertData) {
        return redirect()->route('daftarsemester')
        ->with('status','Semester baru berhasil ditambahkan!');
        }else{
        return redirect()->route('daftarsemester')
        ->with('error','Semester baru gagal ditambahkan!');
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
    public function destroy($id)
    {
        //
    }
}
