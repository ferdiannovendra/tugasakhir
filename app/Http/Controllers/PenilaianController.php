<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\Semester;
use App\Models\Penilaian;
use App\Models\KompetensiDasar;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

class PenilaianController extends Controller
{
    public function index()
    {
        $dataMP = MataPelajaran::all();
        return view('sekolah.admin.rencana_penilaian.index',compact('dataMP'));
    }
    public function index_keterampilan()
    {
        $dataMP = MataPelajaran::all();
        return view('sekolah.admin.rencana_penilaian.keterampilan',compact('dataMP'));
    }
    public function generate_rencana_keterampilan(Request $request)
    {
        $idmp = $request->idmp;
        $jumlah = $request->jumlah;
        $idclass= $request->idclass;
        $kd = KompetensiDasar::where('idmata_pelajaran',$idmp)->where('jenis_kd','Keterampilan')->get();

        return response()->json([
            'jumlah' => $jumlah,
            'kd' => $kd
        ]);
    }
    public function generate_rencana_pengetahuan(Request $request)
    {
        $idmp = $request->idmp;
        $jumlah = $request->jumlah;
        $idclass= $request->idclass;
        $kd = KompetensiDasar::where('idmata_pelajaran',$idmp)->where('jenis_kd','Pengetahuan')->get();

        return response()->json([
            'jumlah' => $jumlah,
            'kd' => $kd
        ]);
    }
    public function kirim_rencana(Request $request)
    {
        // dd($request);
        for ($i=1; $i <= $request->jumlah; $i++) {
            $nama = $request->{'nama_p'.$i};
            $bobot = $request->{'bobot_p'.$i};
            $teknik_penilaian = $request->{'teknik_'.$i};
            // dd($request);
            $penilaian = new Penilaian();
            $penilaian->jenispenilaian = "Pengetahuan";
            $penilaian->teknik_penilaian = $teknik_penilaian;
            $penilaian->nama = $nama;
            $penilaian->bobot = $bobot;
            $penilaian->idmata_pelajaran = $request->matapelajaran;
            $penilaian->idclass = $request->kelas;
            $penilaian->save();

            $p = $request->{'p'.$i};
            for ($j=0; $j < count($p); $j++) {
                $penilaian->kompetensidasar()->attach([$p[$j]]);
            }
        }

        //UNTUK PTS
        $penilaian = new Penilaian();
        $penilaian->jenispenilaian = "Pengetahuan";
        $penilaian->nama = "PTS";
        $penilaian->bobot = $request->bobot_pts;
        $penilaian->idmata_pelajaran = $request->matapelajaran;
        $penilaian->idclass = $request->kelas;
        $penilaian->save();

        $pts = $request->pts;
        for ($i=0; $i < count($pts); $i++) {
            $penilaian->kompetensidasar()->attach($pts[$i]);
        }

        //UNTUK PAS
        $penilaian = new Penilaian();
        $penilaian->jenispenilaian = "Pengetahuan";
        $penilaian->nama = "PAS";
        $penilaian->bobot = $request->bobot_pas;
        $penilaian->idmata_pelajaran = $request->matapelajaran;
        $penilaian->idclass = $request->kelas;
        $penilaian->save();

        $pas = $request->pas;
        for ($i=0; $i < count($pas); $i++) {
            $penilaian->kompetensidasar()->attach($pas[$i]);
        }
        return redirect()->back()->with('status','Berhasil Membuat Rencana Pengetahuan!');

    }
    public function kirim_rencana_keterampilan(Request $request)
    {
        // dd($request);
        for ($i=1; $i <= $request->jumlah; $i++) {
            $nama = $request->{'nama_p'.$i};
            $bobot = $request->{'bobot_p'.$i};
            $teknik_penilaian = $request->{'teknik_'.$i};
            // dd($request);
            $penilaian = new Penilaian();
            $penilaian->jenispenilaian = "Keterampilan";
            $penilaian->teknik_penilaian = $teknik_penilaian;
            $penilaian->nama = $nama;
            $penilaian->bobot = $bobot;
            $penilaian->idmata_pelajaran = $request->matapelajaran;
            $penilaian->idclass = $request->kelas;
            $penilaian->save();

            $p = $request->{'p'.$i};
            for ($j=0; $j < count($p); $j++) {
                $penilaian->kompetensidasar()->attach([$p[$j]]);
            }
        }
        return redirect()->back()->with('status','Berhasil Membuat Rencana Keterampilan!');
    }

    public function duplikatrencananilai(Request $request)
    {
        $cek1 = Penilaian::where('idclass',$request->kelas_awal)->where('idmata_pelajaran',$request->matapelajaran)->first();
        $cek2 = Penilaian::where('idclass',$request->kelas_awal)->where('idclass',$request->kelas_tujuan)->first();
        if ($cek1 != null) {
            if ($cek2 == null) {
                if($request->kelas_awal != $request->kelas_tujuan){
                    $pen = Penilaian::where('idclass', $request->kelas_awal)->where('idmata_pelajaran',$request->matapelajaran)->get();
                    foreach ($pen as $key => $value) {
                        $p = new Penilaian();
                        $p->nama = $value->nama;
                        $p->teknik_penilaian = $value->teknik_penilaian;
                        $p->idmata_pelajaran = $value->idmata_pelajaran;
                        $p->bobot = $value->bobot;
                        $p->idclass = $request->kelas_tujuan;
                        $p->save();
                        foreach ($value->kompetensidasar()->get() as $v) {
                            $p->kompetensidasar()->attach($v->idkompetensi_dasar);
                        }
                    }
                    return redirect()->back()->with('status','Berhasil Duplikat!');
                }else{
                    return redirect()->back()->with('error','Gagal Duplikat!');
                }
            }else{
                return redirect()->back()->with('error','Gagal Duplikat!');
            }
        } else {
            return redirect()->back()->with('error','Gagal Duplikat!');
        }

    }

    public function input_pengetahuan()
    {
        $dataMP = MataPelajaran::all();
        return view('sekolah.admin.input_penilaian.pengetahuan',compact('dataMP'));
    }

    public function input_keterampilan()
    {
        $dataMP = MataPelajaran::all();
        return view('sekolah.admin.input_penilaian.keterampilan',compact('dataMP'));
    }

    public function listpenilaian_pengetahuan(Request $request)
    {
        $idclass = $request->idclass;
        $idmp = $request->idmp;
        $penilaian = Penilaian::where('idmata_pelajaran',$idmp)->where('idclass',$idclass)->where('jenispenilaian','Pengetahuan')->get();

        return response()->json([
            'listpenilaian' => $penilaian
        ]);
    }
    public function listpenilaian_keterampilan(Request $request)
    {
        $idclass = $request->idclass;
        $idmp = $request->idmp;
        $penilaian = Penilaian::where('idmata_pelajaran',$idmp)->where('idclass',$idclass)->where('jenispenilaian','Keterampilan')->get();

        return response()->json([
            'listpenilaian' => $penilaian
        ]);
    }
    public function generate_input_nilai(Request $request)
    {
        $kelas = $request->idclass;
        $mp = $request->id_mp;
        $idpenilaian = $request->idpenilaian;

        $getSiswa = DB::table('siswa_di_kelas')->where('classlist_idclass',$kelas)->join('users','users_idusers','id')->get();
        $kd = Penilaian::find($idpenilaian)->kompetensidasar()->get();
        $nilai = DB::table('nilai_per_penilaian')->where('penilaian_idpenilaian',$idpenilaian)->get();
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('sekolah.admin.input_penilaian.datanilai',compact('kd','getSiswa','nilai'))->render()
        ),200);

    }

    public function kirim_nilai(Request $request)
    {
        // dd($request);
        $getSiswa = DB::table('siswa_di_kelas')->where('classlist_idclass',$request->kelas)->join('users','users_idusers','id')->get();
        $kd = Penilaian::find($request->penilaian)->kompetensidasar()->get();

        foreach ($getSiswa as $s) {
            foreach ($kd as $k) {
                $insert = DB::table('nilai_per_penilaian')->upsert([
                            ['penilaian_idpenilaian' => $request->penilaian,'users_idusers'=>$s->id, 'idkompetensi_dasar' => $k->idkompetensi_dasar, 'nilai' => $request->{'nilai'.$s->id.'_'.$k->idkompetensi_dasar}],
                        ], ['penilaian_idpenilaian', 'users_idusers','idkompetensi_dasar'], ['nilai']);

                // $insert = DB::table('nilai_per_penilaian')->insert([
                //     'penilaian_idpenilaian' => $request->penilaian,
                //     'idkompetensi_dasar' => $k->idkompetensi_dasar,
                //     'users_idusers' => $s->id,
                //     'nilai' => $request->{'nilai'.$s->id.'_'.$k->idkompetensi_dasar}
                // ]);
            }
        }
        return redirect()->back()->with('status','Sukses tambah nilai');

    }

    public function lihatrencana()
    {
        $dataMP = MataPelajaran::all();
        return view('sekolah.admin.rencana_penilaian.lihatrencana',compact('dataMP'));
    }
    public function lihatrencana_keterampilan()
    {
        $dataMP = MataPelajaran::all();
        return view('sekolah.admin.rencana_penilaian.lihatrencanaketerampilan',compact('dataMP'));
    }
    public function detail_rencana(Request $request)
    {
        $kelas = 0;
        $mp = 0;

        $kelas = $request->idclass;
        $mp = $request->idmp;
        // $kelas = 1;
        // $mp = 1;
        // dd($kelas." ".$mp);
        $data = KompetensiDasar::whereHas('penilaian',function($q) use ($kelas, $mp) {
            $q->where('idmata_pelajaran',$mp)->where('idclass', $kelas)->where('jenispenilaian', "Pengetahuan");

        })->get();
        // dd(count($data));
        // dd($data[0]->penilaian()->where('idclass', $kelas)->where('idmata_pelajaran', $mp)->get());
        // dd($data);
        // $data = DB::table('penilaian_has_kompetensi_dasar')->join('kompetensi_dasar','penilaian_has_kompetensi_dasar.idkompetensi_dasar','kompetensi_dasar.idkompetensi_dasar')->get();
        // $kd = Penilaian::where('idclass', $kelas)->where('idmata_pelajaran',$mp)->get();
        // dd($kd);
        // $getSiswa = DB::table('siswa_di_kelas')->where('classlist_idclass',$kelas)->join('users','users_idusers','id')->get();
        // $nilai = DB::table('nilai_per_penilaian')->where('penilaian_idpenilaian',$idpenilaian)->get();
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('sekolah.admin.rencana_penilaian.detail_rencana',compact('data','kelas','mp'))->render()
        ),200);

    }
    public function detail_rencana_keterampilan(Request $request)
    {
        $kelas = $request->idclass;
        $mp = $request->idmp;
        // $kelas = 2;
        // $mp = 1;

        $data = KompetensiDasar::whereHas('penilaian',function($q) use($mp,$kelas) {
            $q->where('idmata_pelajaran',$mp)->where('idclass', $kelas)->where('jenispenilaian', "Keterampilan");
        })->get();

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('sekolah.admin.rencana_penilaian.detail_rencana',compact('data','kelas','mp'))->render()
        ),200);

    }

    // ================== UNTUK SISWA ==================
    public function lihatnilai()
    {
        $now = Carbon::now();
        $hariIni = date('Y-m-d',strtotime($now));
        $cekSemester = Semester::where('start_date','<=',$hariIni)
        ->where('end_date','>=',$hariIni)
        ->first();
        if(isset($cekSemester)){
            $iduser = Auth::user()->id;

            $kelas = DB::table('siswa_di_kelas')->join('class_list','classlist_idclass','idclass_list')
            ->where('siswa_di_kelas.semester_idsemester',$cekSemester->idsemester)
            ->where('siswa_di_kelas.users_idusers',$iduser)
            ->first();

            $count = DB::table('jadwal_kelas')->join('mata_pelajaran','idmatapelajaran','idmata_pelajaran')
            ->select('idclass_list','idmatapelajaran')->where('idclass_list',$kelas->idclass_list)->groupBy('idclass_list','idmatapelajaran')->get();
            dd($count);
            return view('sekolah.siswa.nilai.index',compact('data'));
        }else{
            return view('sekolah.siswa.pending');
        }
    }
}
