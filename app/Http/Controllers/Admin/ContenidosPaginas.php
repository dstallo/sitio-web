<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\AxysListado as Listado;
use App\Axys\Traits\TieneVisibilidad;
use App\Axys\AxysVideo as Video;
use Illuminate\Support\Facades\Validator;

use App\Models\Pagina;
use App\Models\ContenidoPagina as Contenido;

class ContenidosPaginas extends Controller
{
    use TieneVisibilidad;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Pagina $pagina, Request $request)
    {
        
        $contenidos = $pagina->contenidos;

        return view('admin.multimedia-paginas.index', compact('pagina', 'contenidos'));
    }

    public function eliminar(Pagina $pagina, Contenido $contenido)
    {
        try {
            $contenido->delete();
            $flasher=Flasher::set("El contenido multimedia fue eliminado.", 'Contenido Eliminado', 'success');
        } catch (\Exception $e) {
            $flasher=Flasher::set('No se pudo borrar el contenido multimedia.', 'Error', 'error');
        }
        $flasher->flashear();
        return redirect()->back();
    }

    public function crearVideo(Pagina $pagina, Request $request)
    {
        Video::agregarValidacion();

        $this->validate($request, [
            'nombre' => 'required',
            'imagen' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'video' => 'nullable|video',
        ]);

        
        $contenido=new Contenido;
        $contenido->tipo = 'video';
        $contenido->id_pagina = $pagina->id;

        $contenido->fill($request->all())
            ->subir($request->file('imagen'),'imagen')
            ->crearThumbnails()
            ->ordenar([['id_pagina', $pagina->id]])
            ->save();

        
        Flasher::set("El video fue creado exitosamente.", 'Video Creado', 'success')->flashear();

        return back();
    }

    public function subirImagen(Pagina $pagina, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'imagen' => 'file|max:10240|mimes:jpeg,png,jpg',
        ]);
        if ($validator->fails()) {
            return response($validator->messages()->all()[0] ?? "Ocurrió un error al subir el archivo", 422);
        }

        $imagen=(new Contenido)
            ->subir($request->file('imagen'), 'imagen')
            ->crearThumbnails()
            ->ordenar([['id_pagina',$pagina->id]]);

        $imagen->tipo = 'imagen';
        $imagen->nombre = pathinfo($request->file('imagen')->getClientOriginalName(), PATHINFO_FILENAME);

        $pagina->contenidos()->save($imagen);
        
        return response('OK', 200);
    }

    public function editar(Pagina $pagina, Contenido $contenido)
    {
        $video=new Video($contenido->video);
        return view('admin.multimedia-paginas.editar',compact('pagina', 'contenido', 'video'));
    }

    public function guardar(Pagina $pagina, Contenido $contenido, Request $request)
    {
        Video::agregarValidacion();

        $this->validate($request, [
            'nombre' => 'required',
            'imagen' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'video' => 'nullable|video',
        ]);

        $contenido->fill($request->all())
            ->subir($request->file('imagen'),'imagen')
            ->crearThumbnails()
            ->ordenar([['id_pagina', $pagina->id]])
            ->save();

        Flasher::set("El contenido multimedia fue modificado exitosamente.", 'Contenido Editado', 'success')->flashear();
        
        return back();
    }

    public function visibilidad(Pagina $pagina, Contenido $contenido)
    {
        return $this->cambiarVisibilidad($contenido);
    }

    public function eliminarImagen(Pagina $pagina, Contenido $contenido)
    {
        $contenido->eliminarArchivo('imagen')->save();
        Flasher::set("Se eliminó la imagen", 'Archivo Eliminado', 'success')->flashear();
        return back();
    }

    public function ordenar(Pagina $pagina, Request $request)
    {
        $ids = $request->all()['ids'];
        $orden = 1;
        foreach($ids as $id) {
            $pagina->contenidos()->where('id', $id)->update(['orden' => $orden]);
            $orden += 1;
        }
        return ['ok'=>true];
    }
}