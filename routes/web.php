<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\MatriculaController;

Route::resource('alunos', AlunoController::class)->except(['show']);

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('cursos', CursoController::class);
Route::delete('cursos/delete-mass', [CursoController::class, 'deleteMass'])->name('cursos.delete-mass');
Route::get('cursos/create', [CursoController::class, 'create'])->name('cursos.create');
Route::post('cursos', [CursoController::class, 'store'])->name('cursos.store');

Route::get('cursos/{curso}/edit', [CursoController::class, 'edit'])->name('cursos.edit');
Route::put('cursos/{curso}', [CursoController::class, 'update'])->name('cursos.update');

Route::resource('alunos', AlunoController::class)->except(['show']);
Route::get('alunos', [AlunoController::class, 'index'])->name('alunos.index');




Route::get('matriculas', [MatriculaController::class, 'index'])->name('matriculas.index');
Route::get('matriculas/create', [MatriculaController::class, 'create'])->name('matriculas.create');
Route::post('matriculas', [MatriculaController::class, 'store'])->name('matriculas.store');
Route::delete('matriculas/{matricula}', [MatriculaController::class, 'destroy'])->name('matriculas.destroy');


Route::resource('alunos', AlunoController::class)->except(['show']);
Route::resource('cursos', CursoController::class)->except(['show']);
Route::resource('matriculas', MatriculaController::class)->except(['show']);