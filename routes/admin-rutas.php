<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\Administradores;
use App\Http\Controllers\Admin\Slides;
use App\Http\Controllers\Admin\Servicios;
use App\Http\Controllers\Admin\ContenidosServicios;
use App\Http\Controllers\Admin\Novedades;
use App\Http\Controllers\Admin\ContenidosNovedades;
use App\Http\Controllers\Admin\Multimedia;
use App\Http\Controllers\Admin\Iconos;
use App\Http\Controllers\Admin\InscriptosNewsletter;
use App\Http\Controllers\Admin\Consultas;
use App\Http\Controllers\Admin\Popups;
use App\Http\Controllers\Admin\Encuestas;
use App\Http\Controllers\Admin\Preguntas;
use App\Http\Controllers\Admin\Opciones;


Route::get('/', [Dashboard::class, 'index']);

Route::get('administradores', [Administradores::class, 'index'])->name('administradores');
Route::get('administradores/crear', [Administradores::class, 'crear'])->name('crear_administrador');
Route::get('administradores/{administrador}/editar', [Administradores::class, 'editar'])->name('editar_administrador');
Route::post('administradores/guardar/{administrador?}', [Administradores::class, 'guardar'])->name('guardar_administrador');
Route::get('administradores/{administrador}/eliminar', [Administradores::class, 'eliminar'])->name('eliminar_administrador');
Route::get('administradores/{administrador}/eliminar-archivo/{campo}', [Administradores::class, 'eliminarArchivo'])->name('eliminar_archivo_administrador');

/// Newsletter
Route::get('newsletter/inscriptos', [InscriptosNewsletter::class, 'index'])->name('inscriptos_newsletter');
Route::get('newsletter/inscriptos/{inscripto}/editar', [InscriptosNewsletter::class, 'editar'])->name('editar_inscripto_newsletter');
Route::post('newsletter/inscriptos/guardar/{inscripto?}', [InscriptosNewsletter::class, 'guardar'])->name('guardar_inscripto_newsletter');
Route::get('newsletter/inscriptos/{inscripto}/eliminar', [InscriptosNewsletter::class, 'eliminar'])->name('eliminar_inscripto_newsletter');
Route::get('newsletter/inscriptos/exportar', [InscriptosNewsletter::class, 'exportar'])->name('exportar_inscriptos_newsletter');

// consultas
Route::get('consultas', [Consultas::class, 'index'])->name('consultas');
Route::get('consultas/exportar', [Consultas::class, 'exportar'])->name('exportar_consultas');
Route::get('consultas/crear', [Consultas::class, 'crear'])->name('crear_consulta');
Route::get('consultas/{consulta}/editar', [Consultas::class, 'editar'])->name('editar_consulta');
Route::post('consultas/guardar/{consulta?}', [Consultas::class, 'guardar'])->name('guardar_consulta');
Route::get('consultas/{consulta}/eliminar', [Consultas::class, 'eliminar'])->name('eliminar_consulta');
Route::get('consultas/{consulta}/desver', [Consultas::class, 'desver'])->name('desver_consulta');

/// slides
Route::get('slides', [Slides::class, 'index'])->name('slides');
Route::get('slides/crear', [Slides::class, 'crear'])->name('crear_slide');
Route::get('slides/{slide}/editar', [Slides::class, 'editar'])->name('editar_slide');
Route::post('slides/guardar/{slide?}', [Slides::class, 'guardar'])->name('guardar_slide');
Route::get('slides/{slide}/eliminar', [Slides::class, 'eliminar'])->name('eliminar_slide');
Route::get('slides/{slide}/eliminar-archivo/{campo}', [Slides::class, 'eliminarArchivo'])->name('eliminar_archivo_slide');
Route::post('slides/ordenar', [Slides::class, 'ordenar'])->name('ordenar_slides');
Route::get('slides/{slide}/visibilidad', [Slides::class, 'visibilidad'])->name('visibilidad_slide');

// servicios
Route::get('servicios', [Servicios::class, 'index'])->name('servicios');
Route::get('servicios/crear', [Servicios::class, 'crear'])->name('crear_servicio');
Route::get('servicios/{servicio}/editar', [Servicios::class, 'editar'])->name('editar_servicio');
Route::post('servicios/guardar/{servicio?}', [Servicios::class, 'guardar'])->name('guardar_servicio');
Route::get('servicios/{servicio}/eliminar', [Servicios::class, 'eliminar'])->name('eliminar_servicio');
Route::post('servicios/ordenar', [Servicios::class, 'ordenar'])->name('ordenar_servicios');
Route::get('servicios/{servicio}/visibilidad', [Servicios::class, 'visibilidad'])->name('visibilidad_servicio');
Route::get('servicios/{servicio}/eliminar-archivo/{campo}', [Servicios::class, 'eliminarArchivo'])->name('eliminar_archivo_servicio');

// contenidos
Route::get('servicios/{servicio}/multimedia', [ContenidosServicios::class, 'index'])->name('contenidos_servicio');
Route::post('servicios/{servicio}/multimedia/subir', [ContenidosServicios::class, 'subirImagen'])->name('subir_imagen_servicio');
Route::post('servicios/{servicio}/multimedia/crear-video', [ContenidosServicios::class, 'crearVideo'])->name('crear_video_servicio');
Route::get('servicios/{servicio}/multimedia/{contenido}/editar', [ContenidosServicios::class, 'editar'])->name('editar_contenido_servicio');
Route::post('servicios/{servicio}/multimedia/{contenido}/guardar', [ContenidosServicios::class, 'guardar'])->name('guardar_contenido_servicio');
Route::get('servicios/{servicio}/multimedia/{contenido}/eliminar', [ContenidosServicios::class, 'eliminar'])->name('eliminar_contenido_servicio');
Route::get('servicios/{servicio}/multimedia/{contenido}/eliminar-imagen', [ContenidosServicios::class, 'eliminarImagen'])->name('eliminar_imagen_contenido_servicio');
Route::post('servicios/{servicio}/multimedia/ordenar', [ContenidosServicios::class, 'ordenar'])->name('ordenar_contenidos_servicio');

// novedades
Route::get('novedades', [Novedades::class, 'index'])->name('novedades');
Route::get('novedades/crear', [Novedades::class, 'crear'])->name('crear_novedad');
Route::get('novedades/{novedad}/editar', [Novedades::class, 'editar'])->name('editar_novedad');
Route::post('novedades/guardar/{novedad?}', [Novedades::class, 'guardar'])->name('guardar_novedad');
Route::get('novedades/{novedad}/eliminar', [Novedades::class, 'eliminar'])->name('eliminar_novedad');
Route::get('novedades/{novedad}/eliminar-archivo/{campo}', [Novedades::class, 'eliminarArchivo'])->name('eliminar_archivo_novedad');
Route::get('novedades/{novedad}/visibilidad', [Novedades::class, 'visibilidad'])->name('visibilidad_novedad');

// contenidos
Route::get('novedades/{novedad}/multimedia', [ContenidosNovedades::class, 'index'])->name('contenidos_novedad');
Route::post('novedades/{novedad}/multimedia/subir', [ContenidosNovedades::class, 'subirImagen'])->name('subir_imagen_novedad');
Route::post('novedades/{novedad}/multimedia/crear-video', [ContenidosNovedades::class, 'crearVideo'])->name('crear_video_novedad');
Route::get('novedades/{novedad}/multimedia/{contenido}/editar', [ContenidosNovedades::class, 'editar'])->name('editar_contenido_novedad');
Route::post('novedades/{novedad}/multimedia/{contenido}/guardar', [ContenidosNovedades::class, 'guardar'])->name('guardar_contenido_novedad');
Route::get('novedades/{novedad}/multimedia/{contenido}/eliminar', [ContenidosNovedades::class, 'eliminar'])->name('eliminar_contenido_novedad');
Route::get('novedades/{novedad}/multimedia/{contenido}/eliminar-imagen', [ContenidosNovedades::class, 'eliminarImagen'])->name('eliminar_imagen_contenido_novedad');
Route::post('novedades/{novedad}/multimedia/ordenar', [ContenidosNovedades::class, 'ordenar'])->name('ordenar_contenidos_novedad');

// multimedia
Route::get('multimedia', [Multimedia::class, 'index'])->name('contenidos');
Route::post('multimedia/subir', [Multimedia::class, 'subirImagen'])->name('subir_imagen');
Route::post('multimedia/crear-video', [Multimedia::class, 'crearVideo'])->name('crear_video');
Route::get('multimedia/{contenido}/editar', [Multimedia::class, 'editar'])->name('editar_contenido');
Route::post('multimedia/{contenido}/guardar', [Multimedia::class, 'guardar'])->name('guardar_contenido');
Route::get('multimedia/{contenido}/eliminar', [Multimedia::class, 'eliminar'])->name('eliminar_contenido');
Route::get('multimedia/{contenido}/eliminar-imagen', [Multimedia::class, 'eliminarImagen'])->name('eliminar_imagen_contenido');
Route::post('multimedia/ordenar', [Multimedia::class, 'ordenar'])->name('ordenar_contenidos');

// íconos
Route::get('iconos', [Iconos::class, 'index'])->name('iconos');
Route::get('iconos/crear', [Iconos::class, 'crear'])->name('crear_icono');
Route::get('iconos/{icono}/editar', [Iconos::class, 'editar'])->name('editar_icono');
Route::post('iconos/guardar/{icono?}', [Iconos::class, 'guardar'])->name('guardar_icono');
Route::get('iconos/{icono}/eliminar', [Iconos::class, 'eliminar'])->name('eliminar_icono');
Route::post('iconos/ordenar', [Iconos::class, 'ordenar'])->name('ordenar_iconos');
Route::get('iconos/{icono}/visibilidad', [Iconos::class, 'visibilidad'])->name('visibilidad_icono');
Route::get('iconos/{icono}/eliminar-archivo/{campo}', [Iconos::class, 'eliminarArchivo'])->name('eliminar_archivo_icono');

// popups
Route::get('popups', [Popups::class, 'index'])->name('popups');
Route::get('popups/crear', [Popups::class, 'crear'])->name('crear_popup');
Route::get('popups/{popup}/editar', [Popups::class, 'editar'])->name('editar_popup');
Route::post('popups/guardar/{popup?}', [Popups::class, 'guardar'])->name('guardar_popup');
Route::get('popups/{popup}/eliminar', [Popups::class, 'eliminar'])->name('eliminar_popup');
Route::get('popups/{popup}/eliminar-archivo/{campo}', [Popups::class, 'eliminarArchivo'])->name('eliminar_archivo_popup');
Route::get('popups/{popup}/visibilidad', [Popups::class, 'visibilidad'])->name('visibilidad_popup');

// encuestas
Route::get('encuestas', [Encuestas::class, 'index'])->name('encuestas');
Route::get('encuestas/crear', [Encuestas::class, 'crear'])->name('crear_encuesta');
Route::get('encuestas/{encuesta}/editar', [Encuestas::class, 'editar'])->name('editar_encuesta');
Route::post('encuestas/guardar/{encuesta?}', [Encuestas::class, 'guardar'])->name('guardar_encuesta');
Route::get('encuestas/{encuesta}/eliminar', [Encuestas::class, 'eliminar'])->name('eliminar_encuesta');
Route::get('encuestas/{encuesta}/eliminar-archivo/{campo}', [Encuestas::class, 'eliminarArchivo'])->name('eliminar_archivo_encuesta');
Route::get('encuestas/{encuesta}/visibilidad', [Encuestas::class, 'visibilidad'])->name('visibilidad_encuesta');
Route::get('encuestas/{encuesta}/resultados', [Encuestas::class, 'resultados'])->name('resultados_encuesta');

// preguntas
Route::get('encuestas/{encuesta}/preguntas', [Preguntas::class, 'index'])->name('preguntas');
Route::get('encuestas/{encuesta}/preguntas/crear', [Preguntas::class, 'crear'])->name('crear_pregunta');
Route::get('encuestas/{encuesta}/preguntas/{pregunta}/editar', [Preguntas::class, 'editar'])->name('editar_pregunta');
Route::post('encuestas/{encuesta}/preguntas/guardar/{pregunta?}', [Preguntas::class, 'guardar'])->name('guardar_pregunta');
Route::get('encuestas/{encuesta}/preguntas/{pregunta}/eliminar', [Preguntas::class, 'eliminar'])->name('eliminar_pregunta');
Route::get('encuestas/{encuesta}/preguntas/{pregunta}/eliminar-archivo/{campo}', [Preguntas::class, 'eliminarArchivo'])->name('eliminar_archivo_pregunta');
Route::get('encuestas/{encuesta}/preguntas/{pregunta}/visibilidad', [Preguntas::class, 'visibilidad'])->name('visibilidad_pregunta');
Route::post('encuestas/{encuesta}/preguntas/ordenar', [Preguntas::class, 'ordenar'])->name('ordenar_preguntas');

// opciones
Route::get('encuestas/{encuesta}/preguntas/{pregunta}/opciones', [Opciones::class, 'index'])->name('opciones');
Route::get('encuestas/{encuesta}/preguntas/{pregunta}/opciones/crear', [Opciones::class, 'crear'])->name('crear_opcion');
Route::get('encuestas/{encuesta}/preguntas/{pregunta}/opciones/{opcion}/editar', [Opciones::class, 'editar'])->name('editar_opcion');
Route::post('encuestas/{encuesta}/preguntas/{pregunta}/opciones/guardar/{opcion?}', [Opciones::class, 'guardar'])->name('guardar_opcion');
Route::get('encuestas/{encuesta}/preguntas/{pregunta}/opciones/{opcion}/eliminar', [Opciones::class, 'eliminar'])->name('eliminar_opcion');
Route::get('encuestas/{encuesta}/preguntas/{pregunta}/opciones/{opcion}/eliminar-archivo/{campo}', [Opciones::class, 'eliminarArchivo'])->name('eliminar_archivo_opcion');
Route::get('encuestas/{encuesta}/preguntas/{pregunta}/opciones/{opcion}/visibilidad', [Opciones::class, 'visibilidad'])->name('visibilidad_opcion');
Route::post('encuestas/{encuesta}/preguntas/{pregunta}/opciones/ordenar', [Opciones::class, 'ordenar'])->name('ordenar_opciones');