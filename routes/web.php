<?php

use App\Exports\SurveiExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CplController;
use App\Http\Controllers\RpsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\SurveiController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\KontrakController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\SoalSurveiController;
use App\Http\Controllers\BeritaAcaraController;
use App\Http\Controllers\SurveiGuestController;
use App\Http\Controllers\IndikatorSurveiController;
use App\Http\Controllers\MataKuliahDosenController;
use App\Http\Controllers\BeritaAcaraDetailController;
use App\Http\Controllers\RekapBeritaAcaraController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  return view('index');
})->middleware('guest');

Route::get('/pdf/rps', function () {
  return view('template.rps');
});

Route::get('/excel/survei',  [SurveiGuestController::class, 'export2'])->name('exports.view');

Route::resource('/survei-skm', SurveiGuestController::class);

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('/dashboard')->middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
  Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

  Route::prefix('/data-master')->group(function () {
    Route::resource('/fakultas', FakultasController::class);

    Route::resource('/prodi', ProdiController::class);

    Route::resource('/kelas', KelasController::class);
    Route::post('/kelas/addKom', [KelasController::class, 'addKomisaris'])->name('kelas.addKomisaris');

    Route::resource('/dosen', DosenController::class);

    Route::resource('/mahasiswa', MahasiswaController::class);

    Route::resource('/matakuliah', MataKuliahController::class);
    Route::resource('/matakuliah-dosen', MataKuliahDosenController::class);

    Route::resource('/user', UserController::class);
    Route::post('/user/reset-password', [UserController::class, 'reset'])->name('user.reset');
  });

  Route::prefix('/absensi-ba')->group(function () {
    Route::resource('/absensi', AbsensiController::class);
    Route::get('/absensi/{absensi}/{pertemuan}', [AbsensiController::class, 'show'])->name('absensi.show');
    Route::get('/rekap-absensi', [AbsensiController::class, 'showRekap'])->name('rekap-absensi.index');
    Route::get('/rekap-absensi/{absensi}', [AbsensiController::class,'showRekapPerKelas'])->name('rekap-absensi.show');
    Route::get('/rekap-absensi/{absensi}/generate-pdf', [AbsensiController::class,'generatePDF'])->name('rekap-absensi.pdf');

    Route::resource('/rekap-berita-acara', RekapBeritaAcaraController::class);


    Route::resource('/berita-acara', BeritaAcaraController::class);
    Route::resource('/berita-acara-detail', BeritaAcaraDetailController::class);
    Route::get('/berita-acara/{id}/generate-pdf',  [BeritaAcaraDetailController::class, 'generatePDF'])->name('berita.pdf');
  });

  Route::resource('/kontrak', KontrakController::class);
  Route::get('/kontrak/{id}/generate-pdf',  [KontrakController::class, 'generatePDF'])->name('kontrak.pdf');

  Route::prefix('/data-survei')->group(function () {
    Route::resource('/survei', SurveiController::class);
    Route::get('/survei-export', [SurveiGuestController::class, 'export'])->name('export.survei');
    Route::resource('/indikator', IndikatorSurveiController::class);
    Route::resource('/soal', SoalSurveiController::class);
  });

  Route::prefix('/data-rps')->group(function () {
    Route::resource('/rps', RpsController::class);
    Route::get('/rps/{id}/generate-pdf',  [RpsController::class, 'generatePDF'])->name('rps.pdf');
    Route::resource('/cpl', CplController::class)->parameters([
      'rps' => 'id',
  ]);
  Route::get('/dashboard/data-rps/cpl/{rps}', [CplController::class, 'show'])->name('cpl.show');
  });
});

Route::middleware('auth')->group(function () {
  Route::view('about', 'about')->name('about');

  Route::get('users', [UserController::class, 'index'])->name('users.index');
});
