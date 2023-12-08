<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Ceisa40Controller;
use App\Http\Controllers\ceisa\ReferenceController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\InswController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', [AuthController::class, 'login']);
Route::get('ceisa40/download/{idAju}/{idRespon}', [Ceisa40Controller::class, 'downloadRespon']);
Route::get('ceisa40/download/awal/{nomorAju}/{idResponAwal}', [Ceisa40Controller::class, 'downloadResponAwal']);
Route::get('ceisa40/download/draf/{kodeDokumen}/{idHeader}', [Ceisa40Controller::class, 'downloadDrafDokumen']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
    Route::resource('tiket', TiketController::class);
    Route::get('pib/{aju}', [InswController::class, 'getPibData']);
    Route::get('peb/{aju}', [InswController::class, 'getPebData']);
    Route::post('ceisa40/portal/login', [Ceisa40Controller::class, 'loginPortal']);
    Route::post('ceisa40/login', [Ceisa40Controller::class, 'loginCeisa40']);
    Route::get('ceisa40/dokumen/v1', [Ceisa40Controller::class, 'showV1']);
    Route::get('ceisa40/dokumen/jumlah/{kodeDokumen}', [Ceisa40Controller::class, 'showDocCount']);
    Route::get('ceisa40/dokumen/{aju}', [Ceisa40Controller::class, 'show']);
    Route::get('ceisa40/insw/kirim/{idHeader}', [Ceisa40Controller::class, 'kirimUlangInsw']);
    Route::get('ceisa40/riwayat/status/{idHeader}', [Ceisa40Controller::class, 'getRiwayatStatus']);
    Route::get('ceisa40/riwayat/{idHeader}/{nomorAju}', [Ceisa40Controller::class, 'getRiwayatRespon']);
    Route::middleware(['isAdmin'])->prefix('/setting')->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/users/{id}', [UserController::class, 'show']);
    });
});
