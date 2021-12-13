<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Presensi;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\Semester;

use Auth;

class PresensiController extends Controller
{
    public function index()
    {
        $alldata =  Presensi::all();
        // $dataMP = MataPelajaran::all();
        $dataMP = DB::table('jadwal_kelas')->select('nama_mp','idmata_pelajaran')->join('mata_pelajaran','idmatapelajaran','=','idmata_pelajaran')->groupBy('nama_mp','idmata_pelajaran')->get();
        // $kelas = Kelas::all();
        $kelas = DB::table('jadwal_kelas')->select('name_class','class_list.idclass_list')
        ->join('class_list','jadwal_kelas.idclass_list','=','class_list.idclass_list')
        ->groupBy('name_class','class_list.idclass_list')->get();
        // dd($kelas);
        return view('sekolah.admin.presensi.daftarpresensi',["data"=>$alldata, "dataMP"=>$dataMP,"kelas"=>$kelas]);
    }
    public function showpresensimp($id)
    {
        $idmp = $id;
        if ($id == 0) {
            $data = Presensi::all();
        }else{
            $data = Presensi::where("idmatapelajaran", $id)->get();
        }
        $dataMP = MataPelajaran::all();

        return view('sekolah.admin.presensi.daftarpresensi',["data"=>$data,"dataMP"=>$dataMP, "id"=>$idmp]);
    }
    public function destroy(Request $request)
    {
        $presensi = Presensi::find($request->id);
        $presensi->delete();
        return redirect()->back()->with('status','Data Presensi Berhasil dihapus');
    }
    public function store(Request $request)
    {
        try {
            $presensi = new Presensi();
            $presensi->materi = $request->materi;
            $presensi->start_time = $request->start_time;
            $presensi->end_time = $request->end_time;
            $presensi->catatan_pertemuan = $request->catatan;
            $presensi->idmatapelajaran = $request->matapelajaran;
            $presensi->idclass_list = $request->kelas;
            $presensi->save();
            $idpresensi = $presensi->idpresensi;
            $siswa_di_kelas = DB::table('siswa_di_kelas')->where('classlist_idclass',$request->kelas)->get();
            // dd($siswa_di_kelas);
            foreach ($siswa_di_kelas as $key => $value) {
                $generatePresensi = DB::table('rekap_presensi')->insert([
                    'idpresensi' => $presensi->idpresensi,
                    'idsiswa' => $value->users_idusers
                ]);
            }
            return redirect()->back()->with('status','Presensi Berhasil ditambah!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }
    }

    public function detailpresensi($id)
    {
        $idpresensi = $id;
        $presensi = Presensi::find($idpresensi);

        $idmatapelajaran = $presensi->idmatapelajaran;
        $mp = MataPelajaran::find($idmatapelajaran);
        $data = DB::table('rekap_presensi')
        ->join('users','idsiswa','=','id')
        ->join('detail_siswa','id','=','idusers')->where('idpresensi',$idpresensi)->get();

        $countHadir = DB::table('rekap_presensi')->where('idpresensi',$idpresensi)
        ->where('status_presensi',1)->count();
        $countTidakHadir = DB::table('rekap_presensi')->where('idpresensi',$idpresensi)
        ->where('status_presensi',0)->count();
        $countsiswa = DB::table('rekap_presensi')->where('idpresensi',$idpresensi)->count();
        return view('sekolah.admin.presensi.view_siswa',compact('data','countHadir','countTidakHadir','countsiswa','mp','presensi'));
    }

    //--------------- BUAT GURU --------------------
    public function guru_listpresensi()
    {
        $idpengajar = Auth::user()->id;
        // $idclass =
        // $data = Presensi::where('idclass_list', $idpengajar)->get();
        $data = DB::table('presensi')->join('class_list','presensi.idclass_list','class_list.idclass_list')
        ->where('class_list.wali_kelas',$idpengajar)->get();
        $mata_pelajaran = MataPelajaran::where('guru_pengajar',$idpengajar)->get();
        // $kelas = DB::table('siswa_di_kelas')->where();
        // dd($data);
        return view('sekolah.guru.presensi.index',compact('mata_pelajaran','data'));
    }
    public function listkelas(Request $request)
    {
        $id_mp = $request->id_mp;
        $idpengajar = Auth::user()->id;
        $mata_pelajaran = MataPelajaran::where('guru_pengajar',$idpengajar)->get();
        $idclass = DB::table('jadwal_kelas')->select('jadwal_kelas.idclass_list as idclass','class_list.name_class as name_class')
        ->join('class_list','jadwal_kelas.idclass_list','class_list.idclass_list')
        ->where('idmatapelajaran',$id_mp)
        ->groupBy('jadwal_kelas.idclass_list','class_list.name_class')->get();
        // dd($idclass);
        // $data = Presensi::where('idclass_list', $idpengajar)->get();
        // $kelas = DB::table('siswa_di_kelas')->where();
        return response()->json([
            'listkelas' => $idclass
        ]);
    }
    public function ubahpresensi(Request $request)
    {
        $idpengajar = Auth::user()->id;
        $data = Presensi::where('idpengajar', $idpengajar)->get();
        $mata_pelajaran = MataPelajaran::where('guru_pengajar',$idpengajar)->get();
        return view('sekolah.guru.presensi.index',compact('data','mata_pelajaran'));
    }
    public function postTambahPresensi(Request $request)
    {
        $idpengajar = Auth::user()->id;
        $presensi = new Presensi();
        $presensi->materi = $request->materi;
        $presensi->idmatapelajaran = $request->matapelajaran;
        $presensi->start_time = $request->start_time;
        $presensi->end_time = $request->end_time;
        $presensi->catatan_pertemuan = $request->catatan;
        $presensi->save();
        return redirect()->back();
    }
    //--------------- BUAT SISWA --------------------
    public function siswa_listpresensi()
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

            $data = DB::table('jadwal_kelas')->select('idmatapelajaran','nama_mp')->join('mata_pelajaran','idmatapelajaran','idmata_pelajaran')
            ->where('idclass_list',$kelas->idclass_list)->groupBy('idmatapelajaran','nama_mp')->get();
            // dd($count);
            $cekpresensi = DB::table('presensi')
            ->join('rekap_presensi','presensi.idpresensi','rekap_presensi.idpresensi')
            ->where('idclass_list', $kelas->idclass_list)
            ->where('status_presensi','==',0)
            ->where('start_time','<=',$now)
            ->where('end_time','>=',$now)
            ->where('idsiswa',$iduser)->get();
            // dd($cekpresensi);
            return view('sekolah.siswa.presensi.index',compact('data','cekSemester','cekpresensi'));
        }else{
            return view('sekolah.siswa.pending');
        }
    }
    public function isipresensi(Request $request)
    {
        $idsiswa = Auth::user()->id;
        $idpresensi = $request->id;
        $ubah = DB::table('rekap_presensi')->where('idsiswa',$idsiswa)->where('idpresensi',$idpresensi)
        ->update(['status_presensi' => 1]);
    }
}
