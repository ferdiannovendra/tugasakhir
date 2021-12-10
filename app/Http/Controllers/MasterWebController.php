<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterWeb;
use App\Models\Semester;
use App\Models\User;
use App\Models\Setting;
use Carbon\Carbon;
use DB;
use Config;

class MasterWebController extends Controller
{
    public function index()
    {
        $data = MasterWeb::find(1);
        return view('sekolah.admin.masterweb.index',compact('data'));
    }
    public function update(Request $request)
    {
        $now = Carbon::now();

        $data = MasterWeb::find(1);
        if (!empty($request->file('logo'))) {
            $file = $request->file('logo');
            $new_name = "logo".$data->id."_".date('YmdHis', strtotime($now))."_".$file->getClientOriginalName();
            $file->move(('fileupload'), $new_name);
            $data->logo = $new_name;
        }
        $data->footer_text = $request->footer_text;
        $data->instagram = $request->instagram;
        $data->facebook = $request->facebook;
        $data->twitter = $request->twitter;
        $data->save();
        return view('sekolah.admin.masterweb.index',compact('data'));
    }
    public function update_setting(Request $request)
    {

        $data = Setting::find(1);

        $data->idsemester = $request->semester;
        $data->kepala_sekolah = $request->kepsek;
        $data->model_presensi = $request->model_presensi;
        $data->save();
        return redirect()->back()->with('status',"Setting Berhasil disimpan");
    }
    public function setting()
    {
        $data = DB::table('setting')->first();
        $semester = Semester::all();
        $guru = User::where('status','guru')->get();
        // $tes = Config::get('idsemester');
        // dd($tes);
        return view('sekolah.admin.masterweb.setting',compact('data','semester','guru'));
    }
}
