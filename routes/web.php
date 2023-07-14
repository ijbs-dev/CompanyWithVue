<?php // routes\web.php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CollaboratorController; // Importa o controller do colaborador
use App\Http\Controllers\SectorController; // Importa o controller do setor

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /**
     * Rotas do CRUD do colaborador e do setor
     * @see https://laravel.com/docs/8.x/controllers#resource-controllers
     */
    Route::resource('collaborators', CollaboratorController::class); // Rotas do CRUD do colaborador
    Route::resource('sectors', SectorController::class); // Rotas do CRUD do setor
    Route::get('graphic', [CollaboratorController::class, 'CollaboratorBySector'])->name('graphic'); // Rota para o gráfico
    Route::get('reports', [CollaboratorController::class, 'reports'])->name('reports'); // Rota para o relatório
});

require __DIR__.'/auth.php';
