<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\Traits\TieneVisibilidad;
use App\Axys\AxysVideo as Video;
use Illuminate\Support\Facades\Validator;

use App\Models\Ficha;
use App\Models\Contenido as Contenido;

class Contenidos extends Controller
{
    use TieneVisibilidad;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, ?Ficha $ficha = null)
    {
        if ($ficha)
            $contenidos = $ficha->contenidos;
        else
            $contenidos = Contenido::whereNull('id_ficha')->orderBy('orden')->get();

        return view('admin.contenidos.index', compact('ficha', 'contenidos'));
    }

    public function eliminar(Request $request, ?Ficha $ficha = null, Contenido $contenido)
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

    public function crearVideo(Request $request, ?Ficha $ficha = null)
    {
        Video::agregarValidacion();

        $this->validate($request, [
            'nombre' => 'required',
            'imagen' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'video' => 'nullable|video',
        ]);

        
        $contenido=new Contenido;
        $contenido->tipo = 'video';
        $contenido->id_ficha = $ficha?->id;

        $contenido->fill($request->all())
            ->subir($request->file('imagen'),'imagen')
            ->crearThumbnails()
            ->ordenar($ficha ? [['id_ficha', $ficha->id]] : [])
            ->save();

        
        Flasher::set("El video fue creado exitosamente.", 'Video Creado', 'success')->flashear();

        return back();
    }

    public function subirImagen(Request $request, ?Ficha $ficha = null)
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
            ->ordenar($ficha ? [['id_ficha', $ficha->id]] : []);

        $imagen->tipo = 'imagen';
        $imagen->nombre = pathinfo($request->file('imagen')->getClientOriginalName(), PATHINFO_FILENAME);

        if ($ficha)
            $ficha->contenidos()->save($imagen);
        else
            $imagen->save();
        
        return response('OK', 200);
    }

    public function editar(?Ficha $ficha = null, Contenido $contenido)
    {
        $video=new Video($contenido->video);
        return view('admin.contenidos.editar',compact('ficha', 'contenido', 'video'));
    }

    public function guardar(Request $request, ?Ficha $ficha = null, Contenido $contenido)
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
            ->ordenar($ficha ? [['id_ficha', $ficha->id]] : null)
            ->save();

        Flasher::set("El contenido multimedia fue modificado exitosamente.", 'Contenido Editado', 'success')->flashear();
        
        return back();
    }

    public function visibilidad(?Ficha $ficha = null, Contenido $contenido)
    {
        return $this->cambiarVisibilidad($contenido);
    }

    public function eliminarImagen(?Ficha $ficha = null, Contenido $contenido)
    {
        $contenido->eliminarArchivo('imagen')->save();
        Flasher::set("Se eliminó la imagen", 'Archivo Eliminado', 'success')->flashear();
        return back();
    }

    public function ordenar(Request $request)
    {
        $ids = $request->all()['ids'];
        $orden = 1;
        foreach($ids as $id) {
            Contenido::where('id', $id)->update(['orden' => $orden]);
            $orden += 1;
        }
        return ['ok'=>true];
    }
}