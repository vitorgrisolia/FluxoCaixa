<?php

use Illuminate\Support\Facades\Route;
#Controllers
use App\Http\Controllers\CentroCustoController;
use App\Http\Controllers\LancamentoController;
use App\Http\Controllers\TipoController;

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
    return redirect()->route('dashboard');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
| Thomas Melo - 19-09-2022
*/
Route::prefix('dashboard')
    ->middleware(['auth'])
    ->group( function(){
        Route::get('/', function () { 
            return view('dashboard');
        })->name('dashboard');

});

/*
|--------------------------------------------------------------------------
| TIPOS
|--------------------------------------------------------------------------
| Thomas Melo - 19-09-2022
*/

/*
|--------------------------------------------------------------------------
| CENTRO DE CUSTO
|--------------------------------------------------------------------------
| Thomas Melo - 19-09-2022
*/

/*
|--------------------------------------------------------------------------
| LANÇAMENTOS
|--------------------------------------------------------------------------
| Thomas Melo - 19-09-2022
*/

/*
|--------------------------------------------------------------------------
| RELATORIOS
|--------------------------------------------------------------------------
| Thomas Melo - 19-09-2022
*/



require __DIR__.'/auth.php';
