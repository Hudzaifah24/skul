<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BillClassController;
use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\BillPaymentController;
use App\Http\Controllers\Api\ChangePasswordController;
use App\Http\Controllers\Api\GuardianController;
use App\Http\Controllers\Api\LearningController;
use App\Http\Controllers\Api\LibraryController;
use App\Http\Controllers\Api\MemorizationController;
use App\Http\Controllers\Api\PresenceController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SppController;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/loan', [LibraryController::class, 'index']);

    Route::get('/memorization', [MemorizationController::class, 'index']);

    Route::get('/article', [ArticleController::class, 'index']);

    Route::get('/article/{id}', [ArticleController::class, 'show']);

    Route::get('/learning', [LearningController::class, 'index']);

    Route::get('/presence', [PresenceController::class, 'index']);

    Route::get('/presence/detail', [PresenceController::class, 'index2']);

    Route::get('/student', [ProfileController::class, 'index']);

    Route::get('/guardian', [GuardianController::class, 'index']);

    Route::get('/fossil', [ProfileController::class, 'indexFossil']);

    Route::get('/spp', [SppController::class, 'index']);

    Route::post('/spppayment', [SppController::class, 'SppPayment']);

    Route::get('/payment/history', [SppController::class, 'detail']);

    Route::get('/bill', [BillController::class, 'index']);

    Route::get('/billpayment/history', [BillController::class, 'detail']);

    Route::get('/billclass', [BillClassController::class, 'index']);

    Route::post('/billpayment', [BillPaymentController::class, 'billpayment']);

    Route::get('/billclasspayment/history', [BillClassController::class, 'detail']);

    Route::post('/changePassword', [ChangePasswordController::class, 'change']);
});
