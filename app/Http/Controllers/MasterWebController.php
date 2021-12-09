<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterWeb;
use Carbon\Carbon;

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
}
