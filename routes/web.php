<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\General;

if (config('app.env') === 'production') {
    \URL::forceScheme('https');
}

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

Route::prefix('admin')->group(function () {
	require __DIR__.'/admin-auth.php';

	require __DIR__.'/admin-rutas.php';
});

Route::post('ajax/newsletter', [General::class, 'newsletter']);
Route::post('consultar', [General::class, 'consultar'])->name('consultar');
Route::get('/', [General::class, 'home']);
Route::get('consulta-enviada', [General::class, 'consultaEnviada']);

Route::get('novedades/{novedad}/{titulo}', [General::class, 'novedad'])->name('novedad');
Route::get('servicios/{servicio}/{titulo}', [General::class, 'servicio'])->name('servicio');

Route::get('consulta-enviada', [General::class, 'consultaEnviada']);

Route::get('encuesta-satisfaccion', [General::class, 'verEncuesta']);
Route::post('encuesta-satisfaccion', [General::class, 'votarEncuesta']);
Route::get('encuesta-completa', [General::class, 'encuestaCompleta']);