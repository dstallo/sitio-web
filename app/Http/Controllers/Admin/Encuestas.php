<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\AxysListado as Listado;

use App\Models\Encuesta;

class Encuestas extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Encuesta::orderBy('id', 'desc');

        $listado=new Listado(
            'encuestas',
            $query,
            $request,
            [],
            [
                'buscando'  =>[
                    ['campo'=>'nombre','comparacion'=>'like'],
                ],
                'buscando_id' =>[
                    ['campo'=>'id','comparacion'=>'igual']
                ]
            ]
        );
        
        //$encuestas=$listado->paginar(50);
        $encuestas=$listado->get();

        return view('admin.encuestas.index', compact('encuestas', 'listado'));
    }

    public function eliminar(Encuesta $encuesta)
    {
        try {
            $encuesta->delete();
            $flasher=Flasher::set("La encuesta fue eliminada.", 'Encuesta Eliminada', 'success');
        } catch (\Exception $e) {
            $flasher=Flasher::set('No se pudo borrar la encuesta, ya tiene contenido asociado.', 'Error', 'error');
        }
        $flasher->flashear();
        return redirect()->back();
    }

    public function crear(Request $request)
    {
        $encuesta = new Encuesta;

        return view('admin.encuestas.crear',compact('encuesta'));
    }

    public function editar(Encuesta $encuesta, Request $request)
    {
        return view('admin.encuestas.editar',compact('encuesta'));
    }

    public function guardar(Request $request, $id=null)
    {
        $this->validate($request, [
            'nombre' => 'required',
        ]);

        if($id) {
            $encuesta=Encuesta::findOrFail($id);
        } else {
            $encuesta=new Encuesta;
            $encuesta->visible = false;
        }

        $encuesta->fill($request->all())
            ->save();

        if($id) {
            Flasher::set("La encuesta fue modificada exitosamente.", 'Encuesta Editada', 'success')->flashear();
            return back();
        } else {
            Flasher::set("La encuesta fue creada exitosamente.", 'Encuesta Creada', 'success')->flashear();
            return redirect()->route('encuestas');
        }
    }

    public function visibilidad(Encuesta $encuesta)
    {
        if($encuesta->visible) {
            $encuesta->visible = false;
        } else {
            Encuesta::where('visible', true)->update(['visible' => false]);
            $encuesta->visible = true;
        }

        $encuesta->save();

        return back();
    }

    public function resultados(Encuesta $encuesta)
    {
        $encuesta->load(['preguntas', 'preguntas.opciones']);
        return view('admin.encuestas.resultados', compact('encuesta'));
    }
}