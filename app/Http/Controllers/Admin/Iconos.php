<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\AxysListado as Listado;
use App\Axys\Traits\TieneVisibilidad;

use App\Models\Icono;

class Iconos extends Controller
{
    use TieneVisibilidad;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Icono::orderBy('orden');

        $listado=new Listado(
            'iconos',
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
        
        //$iconos=$listado->paginar(50);
        $iconos=$listado->get();

        return view('admin.iconos.index', compact('iconos', 'listado'));
    }

    public function eliminar(Icono $icono)
    {
        try {
            $icono->delete();
            $flasher=Flasher::set("El ícono fue eliminado.", 'Ícono Eliminado', 'success');
        } catch (\Exception $e) {
            $flasher=Flasher::set('No se pudo borrar el ícono, ya tiene contenido asociado.', 'Error', 'error');
        }
        $flasher->flashear();
        return redirect()->back();
    }

    public function eliminarArchivo(Icono $icono, $campo)
    {
        $icono->eliminarArchivo($campo)->save();
        Flasher::set("Se eliminó el archivo $campo", 'Archivo Eliminado', 'success')->flashear();
        return back();
    }

    public function crear(Request $request)
    {
        $icono = new Icono;

        return view('admin.iconos.crear',compact('icono'));
    }

    public function editar(Icono $icono, Request $request)
    {
        return view('admin.iconos.editar',compact('icono'));
    }

    public function guardar(Request $request, $id=null)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'link' => 'nullable|url',
            'imagen' => 'file|mimes:png,jpeg,jpg,svg,gif|max:1024',
        ]);

        if($id) {
            $icono=Icono::findOrFail($id);
        } else {
            $icono=new Icono;
            $icono->ordenar();
        }

        $icono->fill($request->all())
            ->subir($request->file('imagen'),'imagen')
            ->save();

        if($id) {
            Flasher::set("El ícono fue modificado exitosamente.", 'Ícono Editado', 'success')->flashear();
            return back();
        } else {
            Flasher::set("El ícono fue creado exitosamente.", 'Ícono Creado', 'success')->flashear();
            return redirect()->route('iconos');
        }
    }

    public function ordenar(Request $request)
    {
        $ids = $request->all()['ids'];
        $orden = 1;
        foreach($ids as $id) {
            Icono::where('id', $id)->update(['orden' => $orden]);
            $orden += 1;
        }
        return ['ok'=>true];
    }

    public function visibilidad(Icono $icono)
    {
        return $this->cambiarVisibilidad($icono);
    }
}