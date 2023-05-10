<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillClassesController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BillPaymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FossilController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemorizationController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\PresenceDetailController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\SppPaymentController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

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

// Print
Route::get('print', function(){
    return view('pages.invoice.print');
})->name('print');

// Lupa Password
Route::get('forgotPasswprd', function(){
    return view('auth.forgotPassword');
})->name('forgotPasswprd.index');

// Guest
Route::middleware(['guest'])->group(function(){
    Route::get('login', [AuthController::class, 'login'])->name('login');

    Route::post('postLogin', [AuthController::class, 'postLogin'])->name('postLogin');
});

// Auth
Route::middleware(['auth'])->group(function(){
    // Hal ResetPassword
    Route::resource('reset/password', ResetPasswordController::class);


    // Middleware Reset Password
    Route::middleware(['ResetPassword'])->group(function(){
        // Dasboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Pengguna
        Route::resource('admin', AdminController::class)->except('create', 'edit', 'show');

        // Guru
        Route::resource('teacher', TeacherController::class)->except('create', 'edit', 'show');

        // Category
        Route::resource('category', CategoryController::class);

        // Loan
        Route::resource('loan', LoanController::class)->except('create', 'edit', 'show');

        // Learning
        Route::resource('learning', LearningController::class)->except('create', 'edit');

        // Kelas
        Route::resource('class', ClasController::class)->except('create', 'edit');

        // Murid Kelas
        Route::resource('studentClass', StudentClassController::class)->except('create', 'edit');

        // Periods
        Route::resource('period', PeriodController::class)->except('create', 'edit', 'show');
        Route::put('is/active/{id}', [PeriodController::class, 'isActive'])->name('period.is.active');

        // Murid
        Route::resource('student', StudentController::class)->except('create', 'edit');

        // Tagihan
        Route::resource('bill', BillController::class)->except('create', 'edit');

        // Pembayaran Tagihan Umum
        Route::get('billPaymentGeneral', [BillPaymentController::class, 'index'])->name('billPaymentGeneral.index');

        Route::get('billPaymentGeneral/show/{id}', [BillPaymentController::class, 'show'])->name('billPaymentGeneral.show');

        Route::put('billPaymentGeneral/pay/{id}', [BillPaymentController::class, 'update'])->name('billPaymentGeneral.update');

        // Pembayaran Tagihan Kelas
        Route::get('billPaymentClass', [BillClassesController::class, 'index'])->name('billPaymentClass.index');

        Route::get('billPaymentClass/show/{id}', [BillClassesController::class, 'show'])->name('billPaymentClass.show');

        Route::put('billPaymentClass/pay/{id}', [BillClassesController::class, 'update'])->name('billPaymentClass.update');

        // SPP
        Route::resource('spp', SppController::class)->except('create', 'edit');

        // Pembayaran spp
        Route::resource('spppayment', SppPaymentController::class);

        // Orang Tua
        Route::resource('fossil', FossilController::class)->except('create', 'edit');
        Route::post('changefossil/{id}', [FossilController::class, 'change'])->name('fossil.guardian');

        // Reset Password Murid
        Route::post('reset/password/student/{id}', [StudentController::class, 'reset'])->name('reset.password.student');

        // Reset Password Teacher
        Route::post('reset/password/teacher/{id}', [TeacherController::class, 'reset'])->name('reset.password.teacher');

        // Reset Password Pengguna
        Route::post('reset/password/pengguna/{id}', [AdminController::class, 'reset'])->name('reset.password.admin');

        // guardians
        Route::resource('guardian', GuardianController::class);

        // kehadiran
        Route::resource('attendance', AttendanceController::class);

        // Kehadiran
        Route::resource('presence', PresenceController::class)->except('create', 'edit');

        // Kehadiran detail
        Route::resource('presenceDetail', PresenceDetailController::class)->except('create', 'edit', 'show');

        // Hafalan
        Route::resource('memorization', MemorizationController::class);
        Route::put('ganti/total/{id}', [MemorizationController::class, 'change'])->name('ganti.total.hafalan');

        // Article
        Route::resource('article', ArticleController::class);
        Route::put('is/active/article/{id}', [ArticleController::class, 'isActive'])->name('article.is.active');

        // Logout
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');

        /* Excel */

        // Tempate
        Route::get('students/template', [StudentController::class, 'template'])->name('student.template');

        // Export
        Route::get('students/export', [StudentController::class, 'export'])->name('student.export');

        // Export perkelas
        Route::get('students/class/export/{id}', [StudentController::class, 'exportIdClass'])->name('student.class.export');

        // Import
        Route::post('students/import', [StudentController::class, 'import'])->name('student.import');
    });
});

// Auth::routes();
