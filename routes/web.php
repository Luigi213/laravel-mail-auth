<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PageController as PageController;
use App\Http\Controllers\Admin\ProjectController as ProjectController;
use App\Http\Controllers\Admin\TypeController as TypeController;
use App\Http\Controllers\Admin\TechnologyController as TechnologyController;


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

Route::get('/', function(){
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')->group(function(){
    Route::get('/', [PageController::class, 'index'])->name('dashboard');
    Route::resource('/projects', ProjectController::class)->parameters(['projects' => 'project:titolo']);
    Route::resource('/types', TypeController::class)->parameters(['types' => 'type:name']);
    Route::resource('/technologies', TechnologyController::class)->parameters(['technologies' => 'technology:name_tech']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
