<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\HomeAdminSekolahController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KompetensiDasarController;
use App\Http\Controllers\JadwalKelasController;
use App\Http\Controllers\HariController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\BobotController;
use App\Http\Controllers\KategoriMapelController;
use App\Http\Controllers\PengolahanNilaiController;
use App\Http\Controllers\MasterWebController;

use App\Http\Controllers\HomeGuruSekolahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PresensiController;

use App\Http\Controllers\HomeSiswaSekolahController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/cekpy/{id}', [SuperAdminController::class, 'validateNPSN']);

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login-landing', function () {
    return view('auth.login-landing');
})->name('login-landing');
Route::get('/register-landing', function () {
    return view('auth.register-landing');
})->name('register-landing');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // return view('dashboard');
    if (Auth::user()->status == 'admin') {
        return redirect('sekolah/home');
    }elseif (Auth::user()->status == 'guru') {
        return redirect('sekolah/guru/home');
    }elseif (Auth::user()->status == 'siswa') {
        return redirect('sekolah/siswa/home');
    }elseif(Auth::user()->role == 1){
        return redirect('super-admin/home');
    }elseif(Auth::user()->role == 0){
        return redirect('guest/home');
    }
})->name('dashboard');
Route::middleware(['auth'])->group(function () {
    // Route::middleware(['guest'])->group(function () {
        Route::prefix('guest')->group(function () {
            Route::get('/home', [GuestController::class, 'index'])->name('guesthome');
            Route::get('/regissekolah', [GuestController::class, 'regissekolah'])->name('regissekolah');
            Route::get('/proses-daftar', [GuestController::class, 'prosesdaftar'])->name('proses-daftar');
            Route::post('/ceksekolah', [GuestController::class, 'ceksekolah'])->name('ceksekolah');
            Route::post('/simpansekolah', [GuestController::class, 'simpansekolah'])->name('simpansekolah');
        });
    // });

    Route::middleware(['superadmin'])->group(function () {
        Route::prefix('super-admin')->group(function () {
            Route::get('/home', [SuperAdminController::class, 'index'])->name('superadminhome');
            Route::get('/daftarpengajuan', [SuperAdminController::class, 'daftarpengajuan'])->name('daftarpengajuan');
            Route::get('/home/{id}', [SuperAdminController::class, 'detailsekolah'])->name('detailsekolah');
            Route::view('/tambahdata', 'super-admin.tambahdata')->name('tambahdatasekolah');
            Route::post('simpan_data_sekolah', [SuperAdminController::class, 'simpan_data_sekolah'])->name('simpan_data_sekolah');
            Route::post('generateDB', [SuperAdminController::class, 'generateDB'])->name('generateDB');
            Route::post('/simpanubah_tenant/{id}', [SuperAdminController::class, 'simpanubah_tenant'])->name('simpanubah_tenant');

            Route::post('/ubahstatus_selesai', [SuperAdminController::class, 'ubahstatus_selesai'])->name('ubahstatus_selesai');
            Route::post('/ubahstatus_diterima', [SuperAdminController::class, 'ubahstatus_diterima'])->name('ubahstatus_diterima');
            Route::post('/ubahstatus_tolak', [SuperAdminController::class, 'ubahstatus_tolak'])->name('ubahstatus_tolak');
        });
    });

    Route::middleware(['admin'])->group(function () {
        Route::prefix('sekolah')->group(function () {
            Route::get('/home', [HomeAdminSekolahController::class, 'index'])->name('adminsekolahnhome')->middleware('auth');

            Route::get('/setting', [MasterWebController::class, 'setting'])->name('setting');
            Route::post('update_setting', [MasterWebController::class, 'update_setting'])->name('update_setting');
            Route::post('ubah_password', [MasterWebController::class, 'ubah_password'])->name('ubah_password');

            Route::get('/masterweb', [MasterWebController::class, 'index'])->name('masterweb');
            Route::post('update_masterweb', [MasterWebController::class, 'update'])->name('update_masterweb');

            //User
            Route::get('/daftar-user', [UserController::class, 'index'])->name('daftarUser');
            Route::get('/daftar-user/guru', [UserController::class, 'daftarguru'])->name('daftarGuru');
            Route::get('/daftar-user/siswa', [UserController::class, 'daftarsiswa'])->name('daftarSiswa');
            Route::post('postTambahUser', [UserController::class, 'store'])->name('postTambahUser');
            Route::post('postHapusUser', [UserController::class, 'destroy'])->name('postHapusUser');
            Route::post('resetpassword', [UserController::class, 'resetpassword'])->name('resetpassword');
            Route::post('uploadsiswa',[UserController::class, 'importSiswa'])->name('uploadsiswa');
            Route::post('uploadguru',[UserController::class, 'importGuru'])->name('uploadguru');

            //Kelas
            Route::get('/daftar-kelas', [KelasController::class, 'index'])->name('daftarkelas');
            Route::get('/naik-kelas', [KelasController::class, 'naikkelas'])->name('naikkelas');
            Route::post('ceksiswa', [KelasController::class, 'ceksiswa'])->name('ceksiswa');
            Route::post('postUpdateKelas', [KelasController::class, 'postUpdateKelas'])->name('postUpdateKelas');
            Route::view('/tambah-kelas', 'sekolah.admin.tambahkelas')->name('tambahkelas');
            Route::post('postTambahKelas', [KelasController::class, 'store'])->name('postTambahKelas');
            Route::post('postHapusKelas', [KelasController::class, 'destroy'])->name('postHapusKelas');
            Route::post('ubahkelas', [KelasController::class, 'edit'])->name('ubahkelas');
            Route::post('/simpan_ubahkelas/{id}', [KelasController::class, 'update'])->name('simpan_ubahkelas');
            Route::post('/tambah_siswa/{id}', [KelasController::class, 'tambah_siswa'])->name('tambah_siswa');
            Route::post('listsiswa_tambahkelas', [KelasController::class, 'listsiswa_tambahkelas'])->name('listsiswa_tambahkelas');

            //Jurusan
            Route::get('/daftar-jurusan', [JurusanController::class, 'index'])->name('daftarjurusan');
            Route::view('/tambah-jurusan', 'sekolah.admin.tambahjurusan')->name('tambahjurusan');
            Route::post('postTambahJurusan', [JurusanController::class, 'store'])->name('postTambahJurusan');
            Route::post('postHapusJurusan', [JurusanController::class, 'destroy'])->name('postHapusJurusan');
            Route::post('ubahjurusan', [JurusanController::class, 'edit'])->name('ubahjurusan');
            Route::post('/simpan_ubahjurusan/{id}', [JurusanController::class, 'update'])->name('simpan_ubahjurusan');

            //Semester
            Route::get('/daftar-semester', [SemesterController::class, 'index'])->name('daftarsemester');
            Route::post('postTambahSemester', [SemesterController::class, 'store'])->name('postTambahSemester');
            Route::post('postHapusSemester', [SemesterController::class, 'destroy'])->name('postHapusSemester');
            Route::post('ubahsemester', [SemesterController::class, 'edit'])->name('ubahsemester');
            Route::post('/simpan_ubahsemester/{id}', [SemesterController::class, 'update'])->name('simpan_ubahsemester');

            //Mata pelajaran
            Route::get('/daftar-matapelajaran', [MataPelajaranController::class, 'index'])->name('daftarmatapelajaran');
            Route::post('postTambahMP', [MataPelajaranController::class, 'store'])->name('postTambahMP');
            Route::post('postHapusMP', [MataPelajaranController::class, 'destroy'])->name('postHapusMP');
            Route::post('ubahMP', [MataPelajaranController::class, 'edit'])->name('ubahMP');
            Route::post('/simpan_ubahMP/{id}', [MataPelajaranController::class, 'update'])->name('simpan_ubahMP');

            Route::get('/daftar-kategorimp', [KategoriMapelController::class, 'index'])->name('daftarkategori');
            Route::post('postTambahKategoriMP', [KategoriMapelController::class, 'store'])->name('postTambahKategoriMP');
            Route::post('postHapusKategoriMP', [KategoriMapelController::class, 'destroy'])->name('postHapusKategoriMP');
            Route::post('ubahKategoriMP', [KategoriMapelController::class, 'edit'])->name('ubahKategoriMP');
            Route::post('/simpan_ubahKategoriMP/{id}', [KategoriMapelController::class, 'update'])->name('simpan_ubahKategoriMP');

            //Kompetensi Dasar
            // Route::get('/kompetensidasar', [KompetensiDasarController::class, 'index'])->name('daftarkompetensidasar');
            // // Route::view('/tambahkd', 'sekolah.admin.tambahkompetensidasar')->name('tambahkd');
            // Route::get('/kompetensidasar/{id}', [KompetensiDasarController::class, 'showkdmp'])->name('showkdmp');
            // Route::get('/tambahkd', [KompetensiDasarController::class, 'formtambahkd'])->name('tambahkd');
            // Route::post('postTambahKD', [KompetensiDasarController::class, 'store'])->name('postTambahKD');
            // Route::post('postHapusKD', [KompetensiDasarController::class, 'destroy'])->name('postHapusKD');
            // Route::post('ubahkd', [KompetensiDasarController::class, 'edit'])->name('ubahkd');
            // Route::post('/simpan_ubahkd/{id}', [KompetensiDasarController::class, 'update'])->name('simpan_ubahkd');

            //Keuangan - Jenis Pembayaran
            Route::get('/keuangan/jenispembayaran', [PembayaranController::class, 'index'])->name('daftarJenisPembayaran');
            Route::post('postTambahJenisPembayaran', [PembayaranController::class, 'store'])->name('postTambahJenisPembayaran');
            Route::post('postHapusJenisPembayaran', [PembayaranController::class, 'destroy'])->name('postHapusSemester');
            Route::post('ubahJenisPembayaran', [PembayaranController::class, 'edit'])->name('ubahJenisPembayaran');
            Route::post('/simpan_ubahJenisPembayaran/{id}', [PembayaranController::class, 'update'])->name('simpan_ubahJenisPembayaran');

            Route::get('/daftarrekapkeuangan', [PembayaranController::class, 'daftarrekapkeuangan'])->name('daftarrekapkeuangan');
            Route::get('/daftarrekapkeuangan/{id}', [PembayaranController::class, 'daftarrekapkeuangan_kelas'])->name('daftarrekapkeuangan_kelas');
            Route::post('postTambahTagihan', [PembayaranController::class, 'postTambahTagihan'])->name('postTambahTagihan');
            Route::post('postBulkAction', [PembayaranController::class, 'postBulkAction'])->name('postBulkAction');

            Route::get('/jadwalkelas', [JadwalKelasController::class, 'index'])->name('jadwalkelas');
            Route::post('postTambahJadwal', [JadwalKelasController::class, 'store'])->name('postTambahJadwal');
            Route::post('ubahjadwal', [JadwalKelasController::class, 'ubahjadwal'])->name('ubahjadwal');
            Route::post('hapusJadwal', [JadwalKelasController::class, 'hapusJadwal'])->name('hapusJadwal');

            //Presensi
            Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi.admin');
            Route::get('/presensi/{id}', [PresensiController::class, 'showpresensimp'])->name('showpresensimp');
            Route::post('postTambahPresensi', [PresensiController::class, 'store'])->name('postAdminTambahPresensi');
            Route::post('postAdminHapusPresensi', [PresensiController::class, 'destroy'])->name('postAdminHapusPresensi');
            Route::post('ubahstatus_presensi', [PresensiController::class, 'ubahstatus_presensi'])->name('ubahstatus_presensi');
            Route::post('postUbahStatus', [PresensiController::class, 'postUbahStatus'])->name('postUbahStatus');
            Route::get('/presensi/detail/{id}', [PresensiController::class, 'detailpresensi'])->name('detailpresensi');
            // Route::post('listkelas', [PresensiController::class, 'listkelas'])->name('listkelasadmin');

            //Hari
            Route::get('/hari', [HariController::class, 'index'])->name('hari');
            Route::post('postHapusHari', [HariController::class, 'destroy'])->name('postHapusHari');
            Route::post('postTambahHari', [HariController::class, 'store'])->name('postTambahHari');
            Route::post('ubahhari', [HariController::class, 'edit'])->name('ubahhari');
            Route::post('/simpan_ubahhari/{id}', [HariController::class, 'update'])->name('simpan_ubahhari');

            Route::get('/view_siswa_kelas/{id}', [KelasController::class, 'view_siswa_kelas_admin'])->name('view_siswa_kelas_admin');

            // Route::get('/rencana_penilaian', [PenilaianController::class, 'index'])->name('rencana_penilaian_admin');
            // Route::post('generate_rencana_pengetahuan', [PenilaianController::class, 'generate_rencana_pengetahuan'])->name('generate_rencana_pengetahuan');
            // Route::post('kirim_rencana', [PenilaianController::class, 'kirim_rencana'])->name('kirim_rencana');
            // Route::post('kirim_rencana_keterampilan', [PenilaianController::class, 'kirim_rencana_keterampilan'])->name('kirim_rencana_keterampilan');
            // Route::get('/rencana_penilaian_keterampilan', [PenilaianController::class, 'index_keterampilan'])->name('rencana_penilaian_keterampilan_admin');
            // Route::post('generate_rencana_keterampilan', [PenilaianController::class, 'generate_rencana_keterampilan'])->name('generate_rencana_keterampilan');

            // Route::post('duplikatrencananilai', [PenilaianController::class, 'duplikatrencananilai'])->name('duplikatrencananilai');
            // Route::get('/lihatrencana', [PenilaianController::class, 'lihatrencana'])->name('lihatrencana');
            // Route::get('/lihatrencana_keterampilan', [PenilaianController::class, 'lihatrencana_keterampilan'])->name('lihatrencana_keterampilan');
            // Route::post('/detail_rencana', [PenilaianController::class, 'detail_rencana'])->name('detail_rencana');
            // Route::post('/detail_rencana_keterampilan', [PenilaianController::class, 'detail_rencana_keterampilan'])->name('detail_rencana_keterampilan');

            // Route::get('/rencana_bobot', [BobotController::class, 'index'])->name('rencana_bobot');
            // Route::post('detail_bobot', [BobotController::class, 'detail_bobot'])->name('detail_bobot');
            // Route::post('input_bobot', [BobotController::class, 'input_bobot'])->name('input_bobot');

            // //Input Pengetahuan
            // Route::get('/input_pengetahuan', [PenilaianController::class, 'input_pengetahuan'])->name('input_pengetahuan');
            // Route::post('listpenilaian_pengetahuan', [PenilaianController::class, 'listpenilaian_pengetahuan'])->name('listpenilaian_pengetahuan');
            // Route::post('kirim_nilai', [PenilaianController::class, 'kirim_nilai'])->name('kirim_nilai');
            // Route::post('generate_input_nilai', [PenilaianController::class, 'generate_input_nilai'])->name('generate_input_nilai');

            // //Input Keterampilan
            // Route::get('/input_keterampilan', [PenilaianController::class, 'input_keterampilan'])->name('input_keterampilan');
            // Route::post('listpenilaian_keterampilan', [PenilaianController::class, 'listpenilaian_keterampilan'])->name('listpenilaian_keterampilan');
            // Route::post('kirim_nilai', [PenilaianController::class, 'kirim_nilai'])->name('kirim_nilai');
            // Route::post('generate_input_nilai', [PenilaianController::class, 'generate_input_nilai'])->name('generate_input_nilai');

            // //Pengolahan Nilai-Pengetahuan
            // Route::get('/olahnilai_pengetahuan', [PengolahanNilaiController::class, 'index_pengetahuan'])->name('olahnilai_pengetahuan');
            // Route::post('lihat_rincian_pengetahuan', [PengolahanNilaiController::class, 'lihat_rincian_pengetahuan'])->name('lihat_rincian_pengetahuan');

            // //Pengolahan Nilai-Keterampilan
            // Route::get('/olahnilai_keterampilan', [PengolahanNilaiController::class, 'index_keterampilan'])->name('olahnilai_keterampilan');
            // Route::post('lihat_rincian_keterampilan', [PengolahanNilaiController::class, 'lihat_rincian_keterampilan'])->name('lihat_rincian_keterampilan');
        });
    });
    Route::middleware(['adminguru'])->group(function () {
        Route::prefix('sekolah')->group(function () {
            Route::post('ubahpresensi', [PresensiController::class, 'ubahpresensi'])->name('ubahpresensi');
            Route::post('simpan_ubahpresensi/{id}', [PresensiController::class, 'simpan_ubahpresensi'])->name('simpan_ubahpresensi');

            Route::post('listkelas', [PresensiController::class, 'listkelas'])->name('listkelasadmin');

            Route::get('/kompetensidasar', [KompetensiDasarController::class, 'index'])->name('daftarkompetensidasar');
            // Route::view('/tambahkd', 'sekolah.admin.tambahkompetensidasar')->name('tambahkd');
            Route::get('/kompetensidasar/{id}', [KompetensiDasarController::class, 'showkdmp'])->name('showkdmp');
            Route::get('/tambahkd', [KompetensiDasarController::class, 'formtambahkd'])->name('tambahkd');
            Route::post('postTambahKD', [KompetensiDasarController::class, 'store'])->name('postTambahKD');
            Route::post('postHapusKD', [KompetensiDasarController::class, 'destroy'])->name('postHapusKD');
            Route::post('ubahkd', [KompetensiDasarController::class, 'edit'])->name('ubahkd');
            Route::post('/simpan_ubahkd/{id}', [KompetensiDasarController::class, 'update'])->name('simpan_ubahkd');

            Route::get('/rencana_penilaian', [PenilaianController::class, 'index'])->name('rencana_penilaian_admin');
            Route::post('generate_rencana_pengetahuan', [PenilaianController::class, 'generate_rencana_pengetahuan'])->name('generate_rencana_pengetahuan');
            Route::post('kirim_rencana', [PenilaianController::class, 'kirim_rencana'])->name('kirim_rencana');
            Route::post('kirim_rencana_keterampilan', [PenilaianController::class, 'kirim_rencana_keterampilan'])->name('kirim_rencana_keterampilan');
            Route::get('/rencana_penilaian_keterampilan', [PenilaianController::class, 'index_keterampilan'])->name('rencana_penilaian_keterampilan_admin');
            Route::post('generate_rencana_keterampilan', [PenilaianController::class, 'generate_rencana_keterampilan'])->name('generate_rencana_keterampilan');

            Route::post('duplikatrencananilai', [PenilaianController::class, 'duplikatrencananilai'])->name('duplikatrencananilai');
            Route::get('/lihatrencana', [PenilaianController::class, 'lihatrencana'])->name('lihatrencana');
            Route::get('/lihatrencana_keterampilan', [PenilaianController::class, 'lihatrencana_keterampilan'])->name('lihatrencana_keterampilan');
            Route::post('/detail_rencana', [PenilaianController::class, 'detail_rencana'])->name('detail_rencana');
            Route::post('/detail_rencana_keterampilan', [PenilaianController::class, 'detail_rencana_keterampilan'])->name('detail_rencana_keterampilan');

            Route::get('/rencana_bobot', [BobotController::class, 'index'])->name('rencana_bobot');
            Route::post('detail_bobot', [BobotController::class, 'detail_bobot'])->name('detail_bobot');
            Route::post('input_bobot', [BobotController::class, 'input_bobot'])->name('input_bobot');

            //Input Pengetahuan
            Route::get('/input_pengetahuan', [PenilaianController::class, 'input_pengetahuan'])->name('input_pengetahuan');
            Route::post('listpenilaian_pengetahuan', [PenilaianController::class, 'listpenilaian_pengetahuan'])->name('listpenilaian_pengetahuan');
            Route::post('kirim_nilai', [PenilaianController::class, 'kirim_nilai'])->name('kirim_nilai');
            Route::post('generate_input_nilai', [PenilaianController::class, 'generate_input_nilai'])->name('generate_input_nilai');

            //Input Keterampilan
            Route::get('/input_keterampilan', [PenilaianController::class, 'input_keterampilan'])->name('input_keterampilan');
            Route::post('listpenilaian_keterampilan', [PenilaianController::class, 'listpenilaian_keterampilan'])->name('listpenilaian_keterampilan');
            Route::post('kirim_nilai', [PenilaianController::class, 'kirim_nilai'])->name('kirim_nilai');
            Route::post('generate_input_nilai', [PenilaianController::class, 'generate_input_nilai'])->name('generate_input_nilai');

            //Pengolahan Nilai-Pengetahuan
            Route::get('/olahnilai_pengetahuan', [PengolahanNilaiController::class, 'index_pengetahuan'])->name('olahnilai_pengetahuan');
            Route::post('lihat_rincian_pengetahuan', [PengolahanNilaiController::class, 'lihat_rincian_pengetahuan'])->name('lihat_rincian_pengetahuan');
            Route::post('lihat_rapor_pengetahuan', [PengolahanNilaiController::class, 'lihat_rapor_pengetahuan'])->name('lihat_rapor_pengetahuan');
            Route::post('kirimnilai_pengetahuan', [PengolahanNilaiController::class, 'kirimnilai_pengetahuan'])->name('kirimnilai_pengetahuan');

            //Pengolahan Nilai-Keterampilan
            Route::get('/olahnilai_keterampilan', [PengolahanNilaiController::class, 'index_keterampilan'])->name('olahnilai_keterampilan');
            Route::post('lihat_rincian_keterampilan', [PengolahanNilaiController::class, 'lihat_rincian_keterampilan'])->name('lihat_rincian_keterampilan');
            Route::post('lihat_rapor_keterampilan', [PengolahanNilaiController::class, 'lihat_rapor_keterampilan'])->name('lihat_rapor_keterampilan');
            Route::post('kirimnilai_keterampilan', [PengolahanNilaiController::class, 'kirimnilai_keterampilan'])->name('kirimnilai_keterampilan');

            Route::get('/lihatnilai-akhir', [PengolahanNilaiController::class, 'lihatnilaiakhir'])->name('lihatnilai-akhir');
            Route::post('nilai_akhir', [PengolahanNilaiController::class, 'nilai_akhir'])->name('nilai_akhir');

            Route::get('/lihatnilai-rapor', [PengolahanNilaiController::class, 'lihatnilairapor'])->name('lihatnilai-rapor');
            Route::post('nilai_rapor', [PengolahanNilaiController::class, 'nilai_rapor'])->name('nilai_rapor');
            Route::post('kirimnilai_akhirrapor', [PengolahanNilaiController::class, 'kirimnilai_akhirrapor'])->name('kirimnilai_akhirrapor');
        });
    });
    Route::post('getdetailsiswa', [SiswaController::class, 'getdetailsiswa'])->name('getdetailsiswa');
    //Route Untuk sekolah sebagai Guru
    Route::middleware(['guru'])->group(function () {
        Route::prefix('sekolah/guru')->group(function () {
            Route::get('/home', [HomeGuruSekolahController::class, 'index'])->name('homeguru');

            Route::get('/kelas', [KelasController::class, 'list_kelas'])->name('list_kelas');
            Route::get('/view_siswa_kelas/{id}', [KelasController::class, 'view_siswa_kelas'])->name('view_siswa_kelas');
            Route::get('/lihatprogress_siswa/{id}', [KelasController::class, 'lihatprogress_siswa'])->name('lihatprogress_siswa');
            Route::post('postLihatData', [KelasController::class, 'postLihatData'])->name('postLihatData');

            Route::get('/presensi', [PresensiController::class, 'guru_listpresensi'])->name('presensi');
            Route::post('listkelas', [PresensiController::class, 'listkelas'])->name('listkelas');
            Route::post('postTambahPresensi', [PresensiController::class, 'store'])->name('postTambahPresensi');
            Route::get('/presensi/detail/{id}', [PresensiController::class, 'detailpresensi'])->name('detailpresensiguru');

            Route::get('/rencana_penilaian', [PresensiController::class, 'rencana_penilaian'])->name('rencana_penilaian');
        });
    });
    //Route Untuk sekolah sebagai Siswa
    Route::middleware(['siswa'])->group(function () {
        Route::prefix('sekolah/siswa')->group(function () {
            Route::get('/home', [HomeSiswaSekolahController::class, 'index'])->name('homesiswa');
            Route::get('/presensi', [PresensiController::class, 'siswa_listpresensi'])->name('presensi.siswa');
            Route::get('/rekap/{id}', [PresensiController::class, 'rekappresensi'])->name('rekappresensi');
            Route::post('isipresensi', [PresensiController::class, 'isipresensi'])->name('isipresensi');
            Route::post('ajukan_ijin', [PresensiController::class, 'ajukan_ijin'])->name('ajukan_ijin');
            Route::post('simpan_ijin', [PresensiController::class, 'simpan_ijin'])->name('simpan_ijin');

            Route::get('/lihatnilai', [PenilaianController::class, 'lihatnilai'])->name('lihatnilai.siswa');
            Route::get('/lihatnilai/{id}', [PenilaianController::class, 'lihatnilaisemester'])->name('lihatnilai.semester');
            Route::post('/cetaknilai', [PenilaianController::class, 'cetak_pdf'])->name('cetaknilai');

            Route::get('/profil', [HomeSiswaSekolahController::class, 'profil'])->name('profil');

            Route::get('/daftartagihan', [PembayaranController::class, 'daftartagihan'])->name('daftartagihan');
            Route::post('uploadbukti', [PembayaranController::class, 'upload_bukti'])->name('uploadbukti');
        });
    });
});



