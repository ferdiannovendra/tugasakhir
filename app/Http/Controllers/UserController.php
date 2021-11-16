<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $alldata =  DB::table('users')->get();

        return view('sekolah.admin.daftaruser',["data"=>$alldata]);
    }
    public function daftarguru()
    {
        $alldata =  DB::table('users')->where('status','guru')->get();

        return view('sekolah.admin.daftaruser',["data"=>$alldata]);
    }
    public function daftarsiswa()
    {
        $alldata =  DB::table('users')->where('status','siswa')->get();

        return view('sekolah.admin.daftaruser',["data"=>$alldata]);
    }
    public function destroy(Request $request)
    {
        $id = $request->$iduser;
        $delete = DB::table('users')->where('id', $id)->delete();

        if ($delete) {
            return redirect()->route('daftaruser')
            ->with('status','User berhasil dihapus!');
        }else{
            return redirect()->route('daftaruser')
            ->with('error','User gagal dihapus!');
        }
    }
    public function store(Request $request)
    {
        // $id = $request->$iduser;
        // $delete = DB::table('users')->where('id', $id)->delete();

        // if ($delete) {
        //     return redirect()->route('daftaruser')
        //     ->with('status','User berhasil dihapus!');
        // }else{
        //     return redirect()->route('daftaruser')
        //     ->with('error','User gagal dihapus!');
        // }
    }
    public function resetpassword(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $user->password = Hash::make($user->nik);
        if($user->save()){
            return back()->with('status', 'Berhasil di reset.');
        }
        else{
            return back()->with('status', 'Gagal di reset.');
        }
    }
}
