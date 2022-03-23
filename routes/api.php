<?php

use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\SeriviceController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\todoListController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/todolist', [todoListController::class, 'index'])->name('todolist.index');

    Route::get('/todolist/{listId}', [todoListController::class, 'show'])->name('todolist.show');

    Route::post(' /todolist', [todoListController::class, 'store'])->name('todolist.store');

    Route::put(' /todolist/{listId}', [todoListController::class, 'update'])->name('todolist.update');

    Route::delete('todolist/{listId}', [todoListController::class, 'destroy'])->name('todolist.destroy');

    Route::resource('todolist.task', 'App\Http\Controllers\TaskController')->except('show')->shallow();
    Route::resource('label',LabelController::class);

});

Route::get('/service/connect/{service}',[SeriviceController::class,'connect'])->name('service.connect');
Route::post('/service/callback',[SeriviceController::class,'callback'])->name('service.callback');
Route::post('/service/{service}',[SeriviceController::class,'store'])->name('service.store');

Route::post('/register', RegistrationController::class)->name('user.register');
Route::post('/login', \App\Http\Controllers\Auth\LoginController::class)->name('user.login');
