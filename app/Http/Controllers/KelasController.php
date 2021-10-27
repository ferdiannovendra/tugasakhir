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
        $alldata =  DB::select("SELECT c.idclass_list,c.status, c.name_class, u.name, j.nama_jurusan, s.nama_semester, c.created_at, c.updated_at FROM class_list c INNER JOIN users u on c.wali_kelas = u.id
                                                            INNER JOIN jurusan j on c.jurusan_idjurusan = j.idjurusan
                                                            INNER JOIN semester s on c.semester_idsemester = s.idsemester");
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
            'name_class' => $request->nama_kelas,
            'wali_kelas' => $request->wali_kelas,
            'status' => "Aktif",
            'created_at' => $now,
            'jurusan_idjurusan' => $request->jurusan,
            'semester_idsemester' => $request->semester
        ]);

        if ($insertData) {
        return redirect()->route('daftarsemester')
        ->with('status','Kelas baru berhasil ditambahkan!');
        }else{
        return redirect()->route('daftarsemester')
        ->with('error','Kelas baru gagal ditambahkan!');
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
        $idclass = $request->idclass;
        $delete = DB::table('class_list')->where('idclass_list', $idclass)->delete();

        if ($delete) {
            return redirect()->route('daftarkelas')
            ->with('status','Kelas berhasil dihapus!');
        }else{
            return redirect()->route('daftarkelas')
            ->with('error','Kelas gagal dihapus!');
        }
    }
}
