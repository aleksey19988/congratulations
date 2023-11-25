<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\CongratulationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MailLogController;
use App\Http\Controllers\MailTemplateController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::get('/', [AppController::class, 'index'])->name('app.index');
    Route::resource('employees', EmployeeController::class);
    Route::resource('mail-templates', MailTemplateController::class);

    Route::get('/send-congratulation/{employeeId}', function(string $employeeId) {
        $congratulationController = new CongratulationController($employeeId);
        $congratulationController->send();
    })->name('congratulations.send');

    Route::get('mail-log', [MailLogController::class, 'index'])->name('mail-log.index');
});





require __DIR__.'/auth.php';
