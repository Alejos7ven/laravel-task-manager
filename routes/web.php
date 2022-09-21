<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController; 
use App\Http\Controllers\CategoriesController;


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
Route::get('/tasks', function () {
    return view('tasks.index');
});
Route::get('/tasks', [TodoController::class, 'index'])->name('tasks');
Route::post('/tasks', [TodoController::class, 'store'])->name('tasks');

Route::get('/tasks/{id}', [TodoController::class, 'show'])->name('tasks-show');
Route::patch('/tasks/{id}', [TodoController::class, 'update'])->name('tasks-edit');
Route::delete('/tasks/{id}', [TodoController::class, 'destroy'])->name('tasks-destroy');

Route::resource('categories', CategoriesController::class);