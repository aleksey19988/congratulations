<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\CongratulationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MailTemplateController;
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
Route::get('/', [AppController::class, 'index'])->name('app.index');

Route::resource('employees', EmployeeController::class);
Route::resource('mail-templates', MailTemplateController::class);

Route::get('/send-congratulation/{employeeId}', function(string $employeeId) {
    $congratulationController = new CongratulationController($employeeId);
    $congratulationController->send();
})->name('congratulations.send');
