<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Kelas;
use App\Models\DetailSiswa;
use App\Models\User;
use Auth;

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
        return view('sekolah.admin.kelas.daftarkelas',["data"=>$data,
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
        $kelas = Kelas::find($id);
        $dataGuru = DB::table('users')->where('status','guru')->get();
        $dataJurusan = DB::table('jurusan')->get();
        $dataSemester = DB::table('semester')->get();
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('sekolah.admin.kelas.editkelas',compact('kelas','id','dataGuru','dataJurusan','dataSemester'))->render()
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
        $kelas = Kelas::find($id);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $idclass = $request->idclass;
        $kelas = Kelas::find($idclass);
        if ($kelas->delete()) {
            return redirect()->route('daftarkelas')
            ->with('status','Kelas berhasil dihapus!');
        }else{
            return redirect()->route('daftarkelas')
            ->with('error','Kelas gagal dihapus!');
        }
    }
    public function listsiswa_tambahkelas(Request $request)
    {
        $id = $request->id;
        $kelas = Kelas::find($id);
        $siswa = DetailSiswa::all();
        $datasiswa = array();
        foreach ($siswa as $s) {
            $iduser = $s->idusers;
            $db_siswakelas = DB::table('siswa_di_kelas')->where('classlist_idclass', $id)->where('users_idusers',$iduser)->get();
            if (count($db_siswakelas) == 0) {
                $u = DetailSiswa::where('idusers',$iduser)->first();
                array_push($datasiswa,$u);
            }
        }
        // $siswakelas = DB::table('siswa_di_kelas')->where('classlist_idclass', $id)
        // ->join('users','users_idusers','id')
        // ->join('detail_siswa','id','idusers')->get();
        // dd($arr);

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('sekolah.admin.kelas.tambahsiswa',compact('kelas','id','datasiswa','siswakelas'))->render()
        ),200);
    }
    public function tambah_siswa(Request $request, $id)
    {
        $arrSiswa = $request->siswa;
        $idclass = $id;
        foreach ($arrSiswa as $a) {
            DB::table('siswa_di_kelas')->insert([
                'users_idusers' => $a,
                'classlist_idclass' => $idclass,
                'semester_idsemester' =>$request->idsemester
            ]);
        }
        return redirect()->route('daftarkelas')
        ->with('status','Siswa berhasil ditambahkan!');

    }

    //---------------Buat Guru------------------

    public function list_kelas()
    {
        $data = Kelas::where('wali_kelas', Auth::user()->id)->get();
        return view('sekolah.guru.kelas.index',compact('data'));
    }
    public function view_siswa_kelas($id)
    {
        $data = DB::table('siswa_di_kelas')->where('classlist_idclass',$id)->
                join('users','siswa_di_kelas.users_idusers','=','users.id')->get();
        // dd($data);
        return view('sekolah.guru.kelas.view_siswa_kelas',compact('data'));
    }
}
