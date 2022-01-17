<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use App\Models\Pengajuan;
use App\Models\Tenant;
use Auth;

class GuestController extends Controller
{
    public function index()
    {
        return view('guest.index');
    }
    public function regissekolah()
    {
        $cek = Pengajuan::where('users_id',Auth::user()->id)->first();
        $cekStatus = true;
        if ($cek != null) {
            $cekStatus = false;
        }
        return view('guest.daftar',compact('cekStatus'));
    }
    public function ceksekolah(Request $request)
    {
        $anu = array();
        $client = new Client();
        $npsn = $request->npsn;
        $crawler = $client->request('GET', 'https://referensi.data.kemdikbud.go.id/tabs.php?npsn='.$npsn);
        // $table = $crawler->filter('table')->filter('tr')->each(function ($tr, $i) {
        //      return $tr->filter('td')->each(function ($td, $i) {
        //          return $td->filter('a')->each(function ($a, $i) {
        //             return $a->text();
        //             $anu[] = $a->text();
        //         });
        //     });
        // });
        // dd($table[2][3][0]);
        $table = $crawler->filter('table')->filter('tr')->each(function ($tr, $i) {
            return $tr->filter('td')->each(function ($td, $i) {
                return $td->text();
                });
            });
        // dd($table);
        $namasekolah = $table[1][4];
        $alamat = $table[1][12];
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('guest.datasekolah',compact('namasekolah','alamat'))->render()
        ),200);
    }

    public function prosesdaftar()
    {
        $cek = Pengajuan::where('users_id',Auth::user()->id)->first();
        $data = "";
        if ($cek->status == 2) {
            $data = Tenant::where('npsn', $cek->npsn)->first();
        }
        // dd($cek);
        return view('guest.status',compact('cek', 'data'));
    }
    public function simpansekolah(Request $request)
    {
        $npsn = $request->npsn;
        $nama = $request->nama;

        $pengajuan = new Pengajuan();
        $pengajuan->npsn = $npsn;
        $pengajuan->nama_sekolah = $nama;
        $pengajuan->users_id = Auth::user()->id;
        $pengajuan->save();
    }
}
