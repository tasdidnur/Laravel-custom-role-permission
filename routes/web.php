<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');
//dashboard
Route::get('dashboard', [DashboardController::class, 'index']);
Route::get('dashboard/profile', [DashboardController::class, 'profile']);
Route::post('dashboard/profile/update', [DashboardController::class, 'profileUp']);
//dashboard
//user
Route::get('dashboard/users', [UserController::class, 'index'])->name('user.index');
Route::get('dashboard/user/add', [UserController::class, 'add'])->name('user.add');
Route::get('dashboard/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::get('dashboard/user/view/{id}', [UserController::class, 'view'])->name('user.view');
Route::post('dashboard/user/submit', [UserController::class, 'insert']);
Route::post('dashboard/user/update', [UserController::class, 'update']);
Route::post('dashboard/user/delete', [UserController::class, 'delete'])->name('user.delete');
//user
//role
Route::controller(RoleController::class)->group(function () {
    Route::get('dashboard/role', 'index')->name('role.index');
    Route::get('dashboard/role/add', 'add')->name('role.add');
    Route::get('dashboard/role/edit/{slug}', 'edit')->name('role.edit');
    Route::post('dashboard/role/submit', 'insert');
    Route::post('dashboard/role/update', 'update');
    Route::post('dashboard/role/delete', 'delete')->name('role.delete');
});
//role
//permission
Route::controller(PermissionController::class)->group(function(){
     Route::get('dashboard/permission','index')->name('permission.index');
     Route::get('dashboard/permission/add','add')->name('permission.add');
     Route::get('dashboard/permission/edit/{id}','edit')->name('permission.edit');
     Route::post('dashboard/permission/submit','store');
     Route::post('dashboard/permission/update','update');
     Route::post('dashboard/permission/delete','delete')->name('permission.delete');
});
//permission


// default route -----
require __DIR__.'/auth.php';
