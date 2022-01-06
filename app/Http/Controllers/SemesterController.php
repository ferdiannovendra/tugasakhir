<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Semester;

class SemesterController extends Controller
{
    public function index()
    {
        $alldata =  Semester::all();
        return view('sekolah.admin.semester.daftarsemester',["data"=>$alldata]);
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $sem = Semester::find($id);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('sekolah.admin.semester.editsemester',compact('sem','id'))->render()
        ),200);
    }
    public function update(Request $request, $id)
    {
        $sem = Semester::find($id);
        $sem->nama_semester = $request->nama_semester;
        $sem->tahun_ajaran = $request->tahun_ajaran;
        $sem->start_date = $request->start_date;
        $sem->end_date = $request->end_date;
        if ($sem->save()) {
        return redirect()->route('daftarsemester')
        ->with('status','Semester baru berhasil diubah!');
        }else{
        return redirect()->route('daftarsemester')
        ->with('error','Semester baru gagal diubah!');
        }
    }
    public function store(Request $request)
    {
        // $now = Carbon::now();
        // $hariIni = date('Y-m-d',strtotime($now));
        // $cekSemester = Semester::where('start_date','<=',$request->start_date)
        // ->Where('end_date','>=',$request->end_date)
        // ->first();
        // dd($cekSemester);
        // if ($cekSemester == null) {
            $semester = new Semester();
            $semester->nama_semester = $request->nama_semester;
            $semester->tahun_ajaran = $request->tahun_ajaran;
            $semester->start_date = $request->start_date;
            $semester->end_date = $request->end_date;
            if ($semester->save()) {
            return redirect()->route('daftarsemester')
            ->with('status','Semester baru berhasil ditambahkan!');
            }else{
            return redirect()->route('daftarsemester')
            ->with('error','Semester baru gagal ditambahkan!');
            }
        // } else {
        //     return redirect()->route('daftarsemester')
        //     ->with('error','Semester baru gagal ditambahkan! Waktu Bertabrakan');
        // }
    }
    public function destroy(Request $request)
    {
        $idsemester = $request->id;
        $semester = Semester::find($idsemester);

        if ($semester->delete()) {
            return redirect()->route('daftarsemester')
            ->with('status','Semester berhasil dihapus!');
        }else{
            return redirect()->route('daftarsemester')
            ->with('error','Semester gagal dihapus!');
        }
    }
}
