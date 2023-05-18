<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\AxysListado as Listado;
use App\Axys\Traits\TieneVisibilidad;
use App\Axys\AxysVideo as Video;
use Illuminate\Support\Facades\Validator;

use App\Models\Servicio;
use App\Models\ContenidoServicio as Contenido;

class ContenidosServicios extends Controller
{
    use TieneVisibilidad;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Servicio $servicio, Request $request)
    {
        
        $contenidos = $servicio->contenidos;

        return view('admin.multimedia-servicios.index', compact('servicio', 'contenidos'));
    }

    public function eliminar(Servicio $servicio, Contenido $contenido)
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

    public function crearVideo(Servicio $servicio, Request $request)
    {
        Video::agregarValidacion();

        $this->validate($request, [
            'nombre' => 'required',
            'imagen' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'video' => 'nullable|video',
        ]);

        
        $contenido=new Contenido;
        $contenido->tipo = 'video';
        $contenido->id_servicio = $servicio->id;

        $contenido->fill($request->all())
            ->subir($request->file('imagen'),'imagen')
            ->crearThumbnails()
            ->ordenar([['id_servicio', $servicio->id]])
            ->save();

        
        Flasher::set("El video fue creado exitosamente.", 'Video Creado', 'success')->flashear();

        return back();
    }

    public function subirImagen(Servicio $servicio, Request $request)
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
            ->ordenar([['id_servicio',$servicio->id]]);

        $imagen->tipo = 'imagen';
        $imagen->nombre = pathinfo($request->file('imagen')->getClientOriginalName(), PATHINFO_FILENAME);

        $servicio->contenidos()->save($imagen);
        
        return response('OK', 200);
    }

    public function editar(Servicio $servicio, Contenido $contenido)
    {
        $video=new Video($contenido->video);
        return view('admin.multimedia-servicios.editar',compact('servicio', 'contenido', 'video'));
    }

    public function guardar(Servicio $servicio, Contenido $contenido, Request $request)
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
            ->ordenar([['id_servicio', $servicio->id]])
            ->save();

        Flasher::set("El contenido multimedia fue modificado exitosamente.", 'Contenido Editado', 'success')->flashear();
        
        return back();
    }

    public function visibilidad(Servicio $servicio, Contenido $contenido)
    {
        return $this->cambiarVisibilidad($contenido);
    }

    public function eliminarImagen(Servicio $servicio, Contenido $contenido)
    {
        $contenido->eliminarArchivo('imagen')->save();
        Flasher::set("Se eliminó la imagen", 'Archivo Eliminado', 'success')->flashear();
        return back();
    }

    public function ordenar(Servicio $servicio, Request $request)
    {
        $ids = $request->all()['ids'];
        $orden = 1;
        foreach($ids as $id) {
            $servicio->contenidos()->where('id', $id)->update(['orden' => $orden]);
            $orden += 1;
        }
        return ['ok'=>true];
    }
}