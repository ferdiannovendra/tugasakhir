<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Kelas;
class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kelas::all();
        $dataGuru = DB::table('users')->where('status','guru')->get();
        $dataJurusan = DB::table('jurusan')->get();
        $dataSemester = DB::table('semester')->get();
        return view('sekolah.admin.daftarkelas',["data"=>$data,
                                                "dataGuru"=>$dataGuru,
                                                "dataJurusan"=>$dataJurusan,
                                                "dataSemester"=>$dataSemester
                                            ]);
        // $data = Kelas::all();

        // return view('sekolah.admin.daftarkelas',["data"=>$data]);
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
        // $now =  Carbon::now();
        // $insertData = DB::table('class_list')->insert([
        //     'name_class' => $request->nama_kelas,
        //     'wali_kelas' => $request->wali_kelas,
        //     'status' => "Aktif",
        //     'created_at' => $now,
        //     'jurusan_idjurusan' => $request->jurusan,
        //     'semester_idsemester' => $request->semester
        // ]);
        $kelas = new Kelas();
        $kelas->name_class = $request->nama_kelas;
        $kelas->wali_kelas = $request->wali_kelas;
        $kelas->status = "Aktif";
        $kelas->jurusan_idjurusan = $request->jurusan;
        $kelas->semester_idsemester = $request->semester;
        if ($kelas->save()) {
        return redirect()->route('daftarkelas')
        ->with('status','Kelas baru berhasil ditambahkan!');
        }else{
        return redirect()->route('daftarkelas')
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
        // $delete = DB::table('class_list')->where('idclass_list', $idclass)->delete();
        $kelas = Kelas::find($idclass);
        if ($kelas->delete()) {
            return redirect()->route('daftarkelas')
            ->with('status','Kelas berhasil dihapus!');
        }else{
            return redirect()->route('daftarkelas')
            ->with('error','Kelas gagal dihapus!');
        }
    }
}
