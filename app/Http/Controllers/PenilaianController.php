<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\Semester;
use App\Models\Penilaian;
use App\Models\KompetensiDasar;
use App\Models\DetailSiswa;
use App\Models\KategoriMapel;
use App\Models\Jurusan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
use PDF;

class PenilaianController extends Controller
{
    public function index()
    {
        $dataMP = MataPelajaran::all();
        if (Auth::user()->status == "admin") {
            $dataMP = MataPelajaran::all();
        }else{
            $dataMP = MataPelajaran::where('guru_pengajar', Auth::user()->id)->get();
        }
        return view('sekolah.admin.rencana_penilaian.index',compact('dataMP'));
    }
    public function index_keterampilan()
    {
        $dataMP = MataPelajaran::all();
        if (Auth::user()->status == "admin") {
            $dataMP = MataPelajaran::all();
        }else{
            $dataMP = MataPelajaran::where('guru_pengajar', Auth::user()->id)->get();
        }
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
        for ($i=1; $i <= $request->jumlah; $i++) {
            $nama = $request->{'nama_p'.$i};
            $bobot = $request->{'bobot_p'.$i};
            $teknik_penilaian = $request->{'teknik_'.$i};
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
        for ($i=1; $i <= $request->jumlah; $i++) {
            $nama = $request->{'nama_p'.$i};
            $bobot = $request->{'bobot_p'.$i};
            $teknik_penilaian = $request->{'teknik_'.$i};
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
        if (Auth::user()->status == "admin") {
            $dataMP = MataPelajaran::all();
        }else{
            $dataMP = MataPelajaran::where('guru_pengajar', Auth::user()->id)->get();
        }
        return view('sekolah.admin.input_penilaian.pengetahuan',compact('dataMP'));
    }

    public function input_keterampilan()
    {
        $dataMP = MataPelajaran::all();
        if (Auth::user()->status == "admin") {
            $dataMP = MataPelajaran::all();
        }else{
            $dataMP = MataPelajaran::where('guru_pengajar', Auth::user()->id)->get();
        }
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
        $getSiswa = DB::table('siswa_di_kelas')->where('classlist_idclass',$request->kelas)->join('users','users_idusers','id')->get();
        $kd = Penilaian::find($request->penilaian)->kompetensidasar()->get();

        foreach ($getSiswa as $s) {
            foreach ($kd as $k) {
                $insert = DB::table('nilai_per_penilaian')->upsert([
                            ['penilaian_idpenilaian' => $request->penilaian,'users_idusers'=>$s->id, 'idkompetensi_dasar' => $k->idkompetensi_dasar, 'nilai' => $request->{'nilai'.$s->id.'_'.$k->idkompetensi_dasar}],
                        ], ['penilaian_idpenilaian', 'users_idusers','idkompetensi_dasar'], ['nilai']);
            }
        }
        return redirect()->back()->with('status','Sukses tambah nilai');
    }

    public function lihatrencana()
    {
        $dataMP = MataPelajaran::all();
        if (Auth::user()->status == "admin") {
            $dataMP = MataPelajaran::all();
        }else{
            $dataMP = MataPelajaran::where('guru_pengajar', Auth::user()->id)->get();
        }
        return view('sekolah.admin.rencana_penilaian.lihatrencana',compact('dataMP'));
    }
    public function lihatrencana_keterampilan()
    {
        $dataMP = MataPelajaran::all();
        if (Auth::user()->status == "admin") {
            $dataMP = MataPelajaran::all();
        }else{
            $dataMP = MataPelajaran::where('guru_pengajar', Auth::user()->id)->get();
        }
        return view('sekolah.admin.rencana_penilaian.lihatrencanaketerampilan',compact('dataMP'));
    }
    public function detail_rencana(Request $request)
    {
        $kelas = 0;
        $mp = 0;

        $kelas = $request->idclass;
        $mp = $request->idmp;
        $data = KompetensiDasar::whereHas('penilaian',function($q) use ($kelas, $mp) {
            $q->where('idmata_pelajaran',$mp)
            ->where('idclass', $kelas)
            ->where('jenispenilaian', "Pengetahuan");
        })->get();

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
        $semester = Semester::all();
        $cekSemester = Semester::where('start_date','<=',$hariIni)
        ->where('end_date','>=',$hariIni)
        ->first();
        if(isset($cekSemester)){
            $iduser = Auth::user()->id;

            $kelas = DB::table('siswa_di_kelas')->join('class_list','classlist_idclass','idclass_list')
            ->where('siswa_di_kelas.semester_idsemester',$cekSemester->idsemester)
            ->where('siswa_di_kelas.users_idusers',$iduser)
            ->first();

            $da = DB::table('nilai_akhir')->join('mata_pelajaran','nilai_akhir.idmata_pelajaran','mata_pelajaran.idmata_pelajaran')->join('users','users_id','id')->where('nilai_akhir.users_id',$iduser)->get();
            // dd($da[0]->nilai_pengetahuan);
            $data = DB::table('jadwal_kelas')->join('mata_pelajaran','idmatapelajaran','idmata_pelajaran')
            ->select('idclass_list','idmatapelajaran','nama_mp')->where('idclass_list',$kelas->idclass_list)->groupBy('idclass_list','idmatapelajaran','nama_mp')->get();
            // dd($count);
            return view('sekolah.siswa.nilai.index',compact('data','cekSemester','da','semester'));
        }else{
            return view('sekolah.siswa.pending');
        }
    }
    public function cetak_pdf()
    {
    	$now = Carbon::now();
        $hariIni = date('Y-m-d',strtotime($now));
        $semester = Semester::all();
        $cekSemester = Semester::where('start_date','<=',$hariIni)
        ->where('end_date','>=',$hariIni)
        ->first();

        $detail = DetailSiswa::where('idusers',Auth::user()->id)->first();
        $jurusan = Jurusan::find($detail->jurusan_idjurusan);
        $kategori = KategoriMapel::all();
        if(isset($cekSemester)){
            $iduser = Auth::user()->id;

            $kelas = DB::table('siswa_di_kelas')->join('class_list','classlist_idclass','idclass_list')
            ->where('siswa_di_kelas.semester_idsemester',$cekSemester->idsemester)
            ->where('siswa_di_kelas.users_idusers',$iduser)
            ->first();

            $da = DB::table('nilai_akhir')->join('mata_pelajaran','nilai_akhir.idmata_pelajaran','mata_pelajaran.idmata_pelajaran')->join('users','users_id','id')->where('nilai_akhir.users_id',$iduser)->get();
            $data = DB::table('jadwal_kelas')->join('mata_pelajaran','idmatapelajaran','idmata_pelajaran')
            ->select('idclass_list','idmatapelajaran','nama_mp')->where('idclass_list',$kelas->idclass_list)->groupBy('idclass_list','idmatapelajaran','nama_mp')->get();

            // return view('sekolah.siswa.nilai.index',compact('data','cekSemester','da','semester'));
            $pdf = PDF::loadview('sekolah.siswa.nilai.cetaknilai',['semester'=>$cekSemester, 'data'=>$data, 'da'=>$da,'jurusan'=>$jurusan,'detail' => $detail, 'kategori'=>$kategori]);
            return $pdf->stream('cetaknilai.pdf');
        }else{
            return view('sekolah.siswa.pending');
        }
    }
}
