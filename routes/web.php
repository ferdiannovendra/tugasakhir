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

use App\Http\Controllers\HomeGuruSekolahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PresensiController;

use App\Http\Controllers\HomeSiswaSekolahController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // return view('dashboard');
    if (Auth::user()->status == 'admin') {
        return redirect('sekolah/home');
    }elseif (Auth::user()->status == 'guru') {
        return redirect('sekolah/guru/home');
    }elseif (Auth::user()->status == 'siswa') {
        return redirect('sekolah/siswa/home');
    }else{
        return redirect('super-admin/home');
    }
})->name('dashboard');
Route::middleware(['auth'])->group(function () {
    Route::prefix('super-admin')->group(function () {
        Route::get('/home', [SuperAdminController::class, 'index'])->name('superadminhome');
        Route::get('/home/{id}', [SuperAdminController::class, 'detailsekolah'])->name('detailsekolah');
        Route::view('/tambahdata', 'super-admin.tambahdata')->name('tambahdatasekolah');
        Route::post('simpan_data_sekolah', [SuperAdminController::class, 'simpan_data_sekolah'])->name('simpan_data_sekolah');
        Route::post('generateDB', [SuperAdminController::class, 'generateDB'])->name('generateDB');
        Route::post('/simpanubah_tenant/{id}', [SuperAdminController::class, 'simpanubah_tenant'])->name('simpanubah_tenant');
    });

    Route::middleware(['admin'])->group(function () {
        Route::prefix('sekolah')->group(function () {
            Route::get('/home', [HomeAdminSekolahController::class, 'index'])->name('adminsekolahnhome')->middleware('auth');

            //User
            Route::get('/daftar-user', [UserController::class, 'index'])->name('daftarUser');
            Route::get('/daftar-user/guru', [UserController::class, 'daftarguru'])->name('daftarGuru');
            Route::get('/daftar-user/siswa', [UserController::class, 'daftarsiswa'])->name('daftarSiswa');
            Route::post('postTambahUser', [UserController::class, 'store'])->name('postTambahUser');
            Route::post('postHapusUser', [UserController::class, 'destroy'])->name('postHapusUser');
            Route::post('resetpassword', [UserController::class, 'resetpassword'])->name('resetpassword');
            Route::post('uploadsiswa',[UserController::class, 'importSiswa'])->name('uploadsiswa');

            //Kelas
            Route::get('/daftar-kelas', [KelasController::class, 'index'])->name('daftarkelas');
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

            //Kompetensi Dasar
            Route::get('/kompetensidasar', [KompetensiDasarController::class, 'index'])->name('daftarkompetensidasar');
            // Route::view('/tambahkd', 'sekolah.admin.tambahkompetensidasar')->name('tambahkd');
            Route::get('/kompetensidasar/{id}', [KompetensiDasarController::class, 'showkdmp'])->name('showkdmp');
            Route::get('/tambahkd', [KompetensiDasarController::class, 'formtambahkd'])->name('tambahkd');
            Route::post('postTambahKD', [KompetensiDasarController::class, 'store'])->name('postTambahKD');
            Route::post('postHapusKD', [KompetensiDasarController::class, 'destroy'])->name('postHapusKD');
            Route::post('ubahkd', [KompetensiDasarController::class, 'edit'])->name('ubahkd');
            Route::post('/simpan_ubahkd/{id}', [KompetensiDasarController::class, 'update'])->name('simpan_ubahkd');

            //Keuangan - Jenis Pembayaran
            Route::get('/keuangan/jenispembayaran', [PembayaranController::class, 'index'])->name('daftarJenisPembayaran');
            Route::post('postTambahJenisPembayaran', [PembayaranController::class, 'store'])->name('postTambahJenisPembayaran');
            Route::post('postHapusJenisPembayaran', [PembayaranController::class, 'destroy'])->name('postHapusSemester');
            Route::post('ubahJenisPembayaran', [PembayaranController::class, 'edit'])->name('ubahJenisPembayaran');
            Route::post('/simpan_ubahJenisPembayaran/{id}', [PembayaranController::class, 'update'])->name('simpan_ubahJenisPembayaran');


            Route::get('/jadwalkelas', [JadwalKelasController::class, 'index'])->name('jadwalkelas');
            Route::post('postTambahJadwal', [JadwalKelasController::class, 'store'])->name('postTambahJadwal');
            Route::post('ubahjadwal', [JadwalKelasController::class, 'ubahjadwal'])->name('ubahjadwal');

            //Presensi
            Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi.admin');
            Route::get('/presensi/{id}', [PresensiController::class, 'showpresensimp'])->name('showpresensimp');
            Route::post('postTambahPresensi', [PresensiController::class, 'store'])->name('postAdminTambahPresensi');
            Route::post('postAdminHapusPresensi', [PresensiController::class, 'destroy'])->name('postAdminHapusPresensi');
            Route::get('/presensi/detail/{id}', [PresensiController::class, 'detailpresensi'])->name('detailpresensi');
            Route::post('listkelas', [PresensiController::class, 'listkelas'])->name('listkelasadmin');

            //Hari
            Route::get('/hari', [HariController::class, 'index'])->name('hari');
            Route::post('postHapusHari', [HariController::class, 'destroy'])->name('postHapusHari');
            Route::post('postTambahHari', [HariController::class, 'store'])->name('postTambahHari');
            Route::post('ubahhari', [HariController::class, 'edit'])->name('ubahhari');
            Route::post('/simpan_ubahhari/{id}', [HariController::class, 'update'])->name('simpan_ubahhari');

        });
    });

    Route::post('getdetailsiswa', [SiswaController::class, 'getdetailsiswa'])->name('getdetailsiswa');
    //Route Untuk sekolah sebagai Guru
    Route::middleware(['guru'])->group(function () {
        Route::prefix('sekolah/guru')->group(function () {
            Route::get('/home', [HomeGuruSekolahController::class, 'index'])->name('homeguru');

            Route::get('/kelas', [KelasController::class, 'list_kelas'])->name('list_kelas');
            Route::get('/view_siswa_kelas/{id}', [KelasController::class, 'view_siswa_kelas'])->name('view_siswa_kelas');

            Route::get('/presensi', [PresensiController::class, 'guru_listpresensi'])->name('presensi');
            Route::post('listkelas', [PresensiController::class, 'listkelas'])->name('listkelas');
            Route::post('ubahpresensi', [PresensiController::class, 'ubahpresensi'])->name('ubahpresensi');
            Route::post('postTambahPresensi', [PresensiController::class, 'postTambahPresensi'])->name('postTambahPresensi');

            Route::get('/rencana_penilaian', [PresensiController::class, 'rencana_penilaian'])->name('rencana_penilaian');
        });
    });
    //Route Untuk sekolah sebagai Siswa
    Route::middleware(['siswa'])->group(function () {
        Route::prefix('sekolah/siswa')->group(function () {
            Route::get('/home', [HomeSiswaSekolahController::class, 'index'])->name('');
            Route::get('/presensi', [PresensiController::class, 'siswa_listpresensi'])->name('presensi.siswa');

        });
    });
});



