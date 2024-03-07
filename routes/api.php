<?php

use App\Http\Controllers\StudentsController;
use App\Models\Students;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('accept_app', [StudentsController::class, 'create'])->name('accept_app');
Route::post('decline_app', [StudentsController::class, 'update'])->name('decline_app');
Route::get('view_students', [StudentsController::class, 'read'])->name('view_students');
Route::post('delete_students', [StudentsController::class, 'delete'])->name('delete_students');