<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/permission/display',[PermissionController::class , 'display'])->name('permissions.display');
Route::get('/permission/create',[PermissionController::class , 'createPage'])->name('permissions.createPage');
Route::post('/permission/create',[PermissionController::class , 'create'])->name('permissions.create');
Route::get('/permission/edit/{id}',[PermissionController::class , 'edit'])->name('permissions.edit');
// Route::put('/permission/update{id}',[PermissionController::class , 'update'])->name('permissions.update');
Route::put('/permission/update/{id}', [PermissionController::class, 'update'])->name('permissions.update');

Route::get('/permission/delete/{id}',[PermissionController::class , 'delete'])->name('permissions.delete');