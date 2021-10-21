<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SemesterController extends Controller
{
    public function index()
    {
        $alldata =  DB::table('semester')->get();

        return view('sekolah.admin.daftarsemester',["data"=>$alldata]);
    }
    public function store(Request $request)
    {
        $now =  Carbon::now();
        $insertData = DB::table('semester')->insert([
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
    public function destroy(Request $request)
    {
        $idsemester = $request->idsemester;
        $delete = DB::table('semester')->where('idsemester', $idsemester)->delete();

        if ($delete) {
            return redirect()->route('daftarsemester')
            ->with('status','Semester berhasil dihapus!');
        }else{
            return redirect()->route('daftarsemester')
            ->with('error','Semester gagal dihapus!');
        }
    }
}
