<?php

use App\Http\Controllers\BalitaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\PuskesmasController;
use App\Http\Controllers\KaderController;
use App\Http\Controllers\UserController;
use App\Models\Kader;
use App\Http\Controllers\PengukuranController;
use App\Http\Controllers\DataTambahanBalitaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KoordinatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::post('register', [AuthController::class, 'register']);
// Route::post('login', [AuthController::class, 'login']);

// Route::middleware('verify.token')->get('/protected-route', function () {
//     return response()->json(['message' => 'This route is protected']);
// });

Route::post('register', [AuthController::class, 'register'])->withoutMiddleware(['verify.token']);
Route::post('login', [AuthController::class, 'login'])->withoutMiddleware(['verify.token']);

Route::group(['prefix' => 'balitas'], function () {
    Route::get('/stat/doughnut', [BalitaController::class, 'stat_doughnut']);
    Route::get('/stat/stack-bar', [BalitaController::class, 'stat_stack_bar']);
    Route::get('/stat/umum', [BalitaController::class, 'stat_umum']);
});

Route::get('Jadwals/', [JadwalController::class, 'index']);


Route::group(['middleware' => 'api_token_check'], function () {
    Route::resource('kelurahan', KelurahanController::class);
    Route::resource('koordinat', KoordinatController::class);

    Route::group(['prefix' => 'user'], function () {
        Route::get('/{id}', [UserController::class, 'show'])->name('user.show');
        Route::put('/{id}', [UserController::class, 'update'])->name('user.edit');
        Route::get('/username/{username}', [UserController::class, 'findByUsername']);
    });

    //API yang hanya dapat diakses oleh kelurahan
    Route::middleware('check.role:KELURAHAN')->group(function () {
        Route::group(['prefix' => 'posyandu'], function () {
            Route::post('/', [PosyanduController::class, 'store']);
            Route::get('/', [PosyanduController::class, 'index']);
            Route::get('/{id}', [PosyanduController::class, 'show']);
            Route::put('/{id}', [PosyanduController::class, 'update']);
            Route::delete('/{id}', [PosyanduController::class, 'destroy']);
            Route::get('/{posyanduId}/kader',  [KaderController::class, 'getKaderByPosyanduId'])->name('kader.getKaderByPosyanduId');
        });

        Route::group(['prefix' => 'puskesmas'], function () {
            Route::get('/{puskemasId}/posyandu', [PosyanduController::class, 'getPosyanduByPuskesmasId']);
            Route::get('/', [PuskesmasController::class, 'index'])->name('puskesmas.index');
            Route::post('/', [PuskesmasController::class, 'store']);
            Route::get('/{id}',  [PuskesmasController::class, 'show'])->name('puskesmas.show');
            Route::put('/{id}',  [PuskesmasController::class, 'update'])->name('puskesmas.edit');
            Route::delete('/{id}',  [PuskesmasController::class, 'destroy'])->name('puskesmas.delete');
        });

        Route::group(['prefix' => 'kader'], function () {
            Route::get('/', [KaderController::class, 'index'])->name('kader.index');
            Route::post('/', [KaderController::class, 'store']);
            Route::get('/{id}',  [KaderController::class, 'show'])->name('kader.show');
            Route::put('/{id}',  [KaderController::class, 'update'])->name('kader.edit');
            Route::delete('/{id}',  [KaderController::class, 'destroy'])->name('kader.delete');
        });

        Route::group(['prefix' => 'balitas'], function () {
            Route::get('/{id}', [BalitaController::class, 'show']);
            Route::get('/kelurahan/stunting', [BalitaController::class, 'getBalitaStunting']);
        });

        Route::group(['prefix' => 'pengukurans'], function () {
            Route::get('/umur-cat-1/{balita_id}', [PengukuranController::class, 'pengukuranByUmurCat1']);
            Route::get('/umur-cat-2/{balita_id}', [PengukuranController::class, 'pengukuranByUmurCat2']);
            Route::get('/balita/{balita_id}', [PengukuranController::class, 'pengukuranByBalita']);
            Route::get('/umur/{balita_id}/{umur}', [PengukuranController::class, 'pengukuranByUmur']);
        });

        Route::group(['prefix' => 'dataTambahanBalitas'], function () {
            Route::get('/byBalitaId/{balita_id}', [DataTambahanBalitaController::class, 'getDataTambahanByBalita']);
        });

        Route::group(['prefix' => 'jadwals'], function () {
            Route::get('/', [JadwalController::class, 'index']);
            Route::get('/{id}', [JadwalController::class, 'show']);
            Route::post('/', [JadwalController::class, 'store']);
            Route::put('/{id}', [JadwalController::class, 'update']);
            Route::delete('/{id}', [JadwalController::class, 'destroy']);
        });

        Route::group(['prefix' => 'beritas'], function () {
            Route::get('/', [BeritaController::class, 'index']);
            Route::get('/{id}', [BeritaController::class, 'show']);
            Route::post('/', [BeritaController::class, 'store']);
            Route::put('/{id}', [BeritaController::class, 'update']);
            Route::delete('/{id}', [BeritaController::class, 'destroy']);
        });
    });

    //API yang hanya diakses oleh puskesmas
    Route::middleware('check.role:PUSKESMAS')->group(function () {
        Route::group(['prefix' => 'puskesmas'], function () {
            Route::get('/{puskemasId}/posyandu', [PosyanduController::class, 'getPosyanduByPuskesmasId']);
            Route::get('/{id}',  [PuskesmasController::class, 'show'])->name('puskesmas.show');
        });

        Route::group(['prefix' => 'posyandu'], function () {
            Route::get('/{posyanduId}/kader',  [KaderController::class, 'getKaderByPosyanduId'])->name('kader.getKaderByPosyanduId');
        });

        Route::group(['prefix' => 'pengukurans'], function () {
            Route::get('/', [PengukuranController::class, 'index']);
            Route::get('/{id}', [PengukuranController::class, 'show']);
            Route::get('/sort/{sort}', [PengukuranController::class, 'sort']);
            Route::post('/', [PengukuranController::class, 'store']);
            Route::put('/{id}', [PengukuranController::class, 'update']);
            Route::delete('/{id}', [PengukuranController::class, 'destroy']);
            Route::get('/umur-cat-1/{balita_id}', [PengukuranController::class, 'pengukuranByUmurCat1']);
            Route::get('/umur-cat-2/{balita_id}', [PengukuranController::class, 'pengukuranByUmurCat2']);
            Route::get('/balita/{balita_id}', [PengukuranController::class, 'pengukuranByBalita']);
            Route::get('/umur/{balita_id}/{umur}', [PengukuranController::class, 'pengukuranByUmur']);
        });

        Route::group(['prefix' => 'dataTambahanBalitas'], function () {
            Route::get('/', [DataTambahanBalitaController::class, 'index']);
            Route::post('/', [DataTambahanBalitaController::class, 'store']);
            Route::get('/{id}', [DataTambahanBalitaController::class, 'show']);
            Route::put('/{id}', [DataTambahanBalitaController::class, 'update']);
            Route::delete('/{id}', [DataTambahanBalitaController::class, 'destroy']);
            Route::get('/byBalitaId/{balita_id}', [DataTambahanBalitaController::class, 'getDataTambahanByBalita']);
        });

        Route::group(['prefix' => 'balitas'], function () {
            Route::get('/', [BalitaController::class, 'index']);
            Route::get('/{id}', [BalitaController::class, 'show']);
            Route::get('/sort/{sort}', [BalitaController::class, 'sort']);
            Route::post('/', [BalitaController::class, 'store']);
            Route::put('/{id}', [BalitaController::class, 'update']);
            Route::delete('/{id}', [BalitaController::class, 'destroy']);
            Route::get('/stat/doughnut', [BalitaController::class, 'stat_doughnut']);
            Route::get('/stat/stack-bar', [BalitaController::class, 'stat_stack_bar']);
            Route::get('/stat/umum', [BalitaController::class, 'stat_umum']);
            Route::get('/posyandu/{id_posyandu}', [BalitaController::class, 'getBalitaByPosyandu']);
            Route::get('/puskesmas/{id_puskesmas}', [BalitaController::class, 'getBalitaByPuskesmas']);
        });
    });

    //API yang hanya diakses oleh posyandu
    Route::middleware('check.role:POSYANDU')->group(function () {
        Route::group(['prefix' => 'posyandu'], function () {
            Route::get('/{id}', [PosyanduController::class, 'show']);
            Route::get('/{posyanduId}/kader',  [KaderController::class, 'getKaderByPosyanduId'])->name('kader.getKaderByPosyanduId');
        });

        Route::group(['prefix' => 'balitas'], function () {
            Route::get('/{id}', [BalitaController::class, 'show']);
            Route::get('/sort/{sort}', [BalitaController::class, 'sort']);
            Route::post('/', [BalitaController::class, 'store']);
            Route::get('/stat/doughnut', [BalitaController::class, 'stat_doughnut']);
            Route::get('/stat/stack-bar', [BalitaController::class, 'stat_stack_bar']);
            Route::get('/stat/umum', [BalitaController::class, 'stat_umum']);
        });

        Route::group(['prefix' => 'pengukurans'], function () {
            Route::get('/{id}', [PengukuranController::class, 'show']);
            Route::get('/sort/{sort}', [PengukuranController::class, 'sort']);
            Route::post('/', [PengukuranController::class, 'store']);
            Route::put('/{id}', [PengukuranController::class, 'update']);
            Route::delete('/{id}', [PengukuranController::class, 'destroy']);
            Route::get('/umur-cat-1/{balita_id}', [PengukuranController::class, 'pengukuranByUmurCat1']);
            Route::get('/umur-cat-2/{balita_id}', [PengukuranController::class, 'pengukuranByUmurCat2']);
            Route::get('/balita/{balita_id}', [PengukuranController::class, 'pengukuranByBalita']);
            Route::get('/umur/{balita_id}/{umur}', [PengukuranController::class, 'pengukuranByUmur']);
        });

        Route::group(['prefix' => 'dataTambahanBalitas'], function () {
            Route::post('/', [DataTambahanBalitaController::class, 'store']);
            Route::get('/{id}', [DataTambahanBalitaController::class, 'show']);
            Route::put('/{id}', [DataTambahanBalitaController::class, 'update']);
            Route::delete('/{id}', [DataTambahanBalitaController::class, 'destroy']);
            Route::get('/byBalitaId/{balita_id}', [DataTambahanBalitaController::class, 'getDataTambahanByBalita']);
        });
    });
});
