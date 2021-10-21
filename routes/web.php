<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\HomeAdminSekolahController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\PembayaranController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // return view('dashboard');
    if (Auth::user()->status == 'admin') {
        return redirect('sekolah/home');
    }elseif (Auth::user()->status == 'guru') {
        // return redirect('sekolah/home');
    }elseif (Auth::user()->status == 'siswa') {
        // return redirect('sekolah/home');
    }else{
        return redirect('super-admin/home');
    }
})->name('dashboard');


Route::prefix('super-admin')->group(function () {
    Route::get('/home', [SuperAdminController::class, 'index'])->name('superadminhome')->middleware('auth');
    Route::view('/tambahdata', 'super-admin.tambahdata')->name('tambahdatasekolah');
});

Route::prefix('sekolah')->group(function () {
    Route::get('/home', [HomeAdminSekolahController::class, 'index'])->name('adminsekolahnhome')->middleware('auth');

    //Kelas
    Route::get('/daftar-kelas', [KelasController::class, 'index'])->name('daftarkelas');
    Route::view('/tambah-kelas', 'sekolah.admin.tambahkelas')->name('tambahkelas');

    //Jurusan
    Route::get('/daftar-jurusan', [JurusanController::class, 'index'])->name('daftarjurusan');
    Route::view('/tambah-jurusan', 'sekolah.admin.tambahjurusan')->name('tambahjurusan');
    Route::post('postTambahJurusan', [JurusanController::class, 'store'])->name('postTambahJurusan');
    Route::post('postHapusJurusan', [JurusanController::class, 'destroy'])->name('postHapusJurusan');

    //Semester
    Route::get('/daftar-semester', [SemesterController::class, 'index'])->name('daftarsemester');
    Route::post('postTambahSemester', [SemesterController::class, 'store'])->name('postTambahSemester');
    Route::post('postHapusSemester', [SemesterController::class, 'destroy'])->name('postHapusSemester');

    //Keuangan - Jenis Pembayaran
    Route::get('/keuangan/jenispembayarn', [PembayaranController::class, 'index'])->name('daftarJenisPembayaran');
    Route::post('postTambahJenisPembayaran', [PembayaranController::class, 'store'])->name('postTambahJenisPembayaran');
    Route::post('postHapusJenisPembayaran', [PembayaranController::class, 'destroy'])->name('postHapusSemester');

});
