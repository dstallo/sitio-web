<?php

use App\Http\Controllers\General;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Localizacion;

if (config('app.env') === 'production') {
	URL::forceScheme('https');
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
	require __DIR__ . '/admin-auth.php';

	require __DIR__ . '/admin-rutas.php';
});

Route::get('/', [General::class, 'home']);

Route::get('idioma/{idioma}', [Localizacion::class, 'cambiarIdioma']);

Route::post('ajax/newsletter', [General::class, 'newsletter']);
Route::post('consultar', [General::class, 'consultar'])->name('consultar');
Route::get('consulta-enviada', [General::class, 'consultaEnviada']);

Route::get('novedades', [General::class, 'novedades'])->name('novedades');
Route::get('sucursales', [General::class, 'sucursales'])->name('sucursales');
Route::get('publicaciones', [General::class, 'publicaciones'])->name('publicaciones');

Route::get('novedades/{novedad}/{titulo}', [General::class, 'novedad'])->name('novedad');
Route::get('servicios/{servicio}/{titulo}', [General::class, 'servicio'])->name('servicio');
Route::get('paginas/{pagina:slug}', [General::class, 'pagina'])->name('pagina');
Route::get('publicaciones/{publicacion}/{titulo}', [General::class, 'publicacion'])->name('publicacion');

Route::get('encuesta-satisfaccion', [General::class, 'verEncuesta'])->name('ver_encuesta');
Route::post('encuesta-satisfaccion', [General::class, 'votarEncuesta']);
Route::get('encuesta-completa', [General::class, 'encuestaCompleta']);

