<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Presensi;
use Carbon\Carbon;

class HomeAdminSekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //SIAPIN ISI BUAT DITAMPILIN PAS BUKA HOME ADMIN SEKOLAH
        $now = Carbon::now();

        $guruCewek = User::where('status','guru')->where('gender','P')->count();
        $guruCowok = User::where('status','guru')->where('gender','L')->count();

        $siswaCowok = User::where('status','siswa')->where('gender','L')->count();
        $siswaCewek = User::where('status','siswa')->where('gender','P')->count();

        $totalKelas = Kelas::count();
// dd($now->toDateTimeString());
        $start = $now->toDateString().' 00:00:00.000';
        $end = $now->toDateString().' 23:59:59.000';
        $presensi = Presensi::whereBetween('start_time',[$start, $end])->count();
        $tes = Carbon::now()->format('l');
        $hari = "";
        if ($tes == "Monday") {
            $hari = "Senin";
        } else if ($tes == "Tuesday"){
            $hari = "Selasa";
        } else if ($tes == "Wednesday"){
            $hari = "Rabu";
        } else if ($tes == "Thursday"){
            $hari = "Kamis";
        } else if ($tes == "Friday"){
            $hari = "Jumat";
        } else if ($tes == "Saturday"){
            $hari = "Sabtu";
        } else {
            $hari = "Minggu";
        }

        $data = DB::table('jadwal_kelas')
        ->join('hari','hari_id','id')
        ->join('mata_pelajaran','idmatapelajaran','idmata_pelajaran')
        ->where('hari.nama', $hari)
        ->orderBy('hari_id', 'asc')
        ->orderBy('jam_mulai','asc')->get();

        return view('sekolah.admin.index',compact('guruCewek','guruCowok', 'siswaCowok', 'siswaCewek', 'totalKelas', 'presensi', 'data'));
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
}
