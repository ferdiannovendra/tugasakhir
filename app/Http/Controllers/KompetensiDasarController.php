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

        return view('sekolah.admin.kompetensidasar.daftarkompetensidasar',["data"=>$data,"dataMP"=>$dataMP,"dataGuru"=>$dataGuru]);
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
        for ($i = 0; $i < count($request->matapelajaran); $i++) {
            $kd = new KompetensiDasar();
            $kd->idmata_pelajaran = $request->matapelajaran[$i];
            $kd->tingkat_pendidikan = $request->tingkatpendidikan[$i];
            $kd->jenis_kd = $request->jenis[$i];
            $kd->semester = $request->semester[$i];
            $kd->kode_kd = $request->kode_kd[$i];
            $kd->kompetensi_dasar = $request->kompetensi_dasar[$i];
            $kd->ringkasan_deskripsi = $request->ringkasan[$i];
            $kd->status = "Aktif";
            $kd->save();
        }

        return redirect()->route('daftarkompetensidasar')
        ->with('status','Kompetensi Dasar baru berhasil ditambahkan!');

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
        $kd = KompetensiDasar::find($id);
        $dataMP = MataPelajaran::all();

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('sekolah.admin.kompetensidasar.ubahkd',compact('kd','dataMP','id'))->render()
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
        $kd = KompetensiDasar::find($id);
        $kd->idmata_pelajaran = $request->matapelajaran;
        $kd->tingkat_pendidikan = $request->tingkatpendidikan;
        $kd->jenis_kd = $request->jenis;
        $kd->semester = $request->semester;
        $kd->kode_kd = $request->kode_kd;
        $kd->kompetensi_dasar = $request->kompetensi_dasar;
        $kd->ringkasan_deskripsi = $request->ringkasan;
        $kd->status = $request->status;
        if($kd->save()){
            return redirect()->route('daftarkompetensidasar')
            ->with('status','Kompetensi Dasar berhasil diubah!');
        }else{
            return redirect()->route('daftarkompetensidasar')
            ->with('status','Kompetensi Dasar gagal diubah!');

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
        $id= $request->id;
        $kd = KompetensiDasar::find($id);
        // return $id;
        $kd->delete();
        return redirect()->route('daftarkompetensidasar')
        ->with('status','Kompetensi Dasar baru berhasil dihapus!');
    }

    public function showkdmp($id)
    {
        $idmp = $id;
        if ($id == 0) {
            $data = KompetensiDasar::all();
        }else{
            $data = KompetensiDasar::where("idmata_pelajaran", $id)->get();
        }
        $dataMP = MataPelajaran::all();
        $dataGuru = DB::table('users')->where('status','guru')->get();

        return view('sekolah.admin.kompetensidasar.daftarkompetensidasar',["data"=>$data,"dataMP"=>$dataMP,"dataGuru"=>$dataGuru,"id"=>$idmp]);

    }
    public function formtambahkd()
    {
        $dataMP = MataPelajaran::all();
        $dataGuru = DB::table('users')->where('status','guru')->get();

        return view('sekolah.admin.kompetensidasar.tambahkompetensidasar',["dataMP"=>$dataMP,"dataGuru"=>$dataGuru]);
    }
    public function postTambahKD(Request $request)
    {
        foreach ($request->tingkatpendidikan as $value) {
            echo $value;
        }
        dd($request);
        // return redirect()->route('daftarkompetensidasar')
        // ->with('status','Kompetensi Dasar baru berhasil ditambahkan!');
    }

}
