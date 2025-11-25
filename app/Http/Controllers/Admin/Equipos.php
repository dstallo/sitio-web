<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\AxysListado as Listado;
use App\Axys\Traits\TieneVisibilidad;

use App\Models\Equipo;

class Equipos extends Controller
{
    use TieneVisibilidad;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Equipo::orderBy('equipo')->orderBy('orden');

        $listado=new Listado(
            'equipos',
            $query,
            $request,
            [],
            [
                'buscando'  =>[
                    ['campo'=>'nombre','comparacion'=>'like'],
                    ['campo'=>'equipo','comparacion'=>'like'],
                ],
                'buscando_id' =>[
                    ['campo'=>'id','comparacion'=>'igual']
                ]
            ]
        );
        
        $equipos=$listado->paginar(50);

        return view('admin.equipos.index', compact('equipos', 'listado'));
    }

    public function eliminar(Equipo $equipo)
    {
        try {
            $equipo->delete();
            $flasher=Flasher::set("El miembro del equipo fue eliminado.", 'Miembro Eliminado', 'success');
        } catch (\Exception $e) {
            $flasher=Flasher::set('No se pudo borrar el miembro del equipo, ya tiene contenido asociado.', 'Error', 'error');
        }
        $flasher->flashear();
        return redirect()->back();
    }

    public function eliminarArchivo(Equipo $equipo, $campo)
    {
        $equipo->eliminarArchivo($campo)->save();
        Flasher::set("Se eliminó la $campo", 'Archivo Eliminado', 'success')->flashear();
        return back();
    }

    public function crear(Request $request)
    {
        $equipo = new Equipo;
        $equipos = Equipo::list();
        return view('admin.equipos.crear',compact('equipo', 'equipos'));
    }

    public function editar(Equipo $equipo, Request $request)
    {
        $equipos = Equipo::list();
        return view('admin.equipos.editar',compact('equipo', 'equipos'));
    }

    public function guardar(Request $request, $id=null)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'equipo' => 'required',
            'descripcion' => 'nullable',
            'imagen' => ['file', 'mimes:'.config('app.image_mimes'),'max:'.config('app.image_size')],
        ], [
            'nombre' => 'Debes completar el nombre del miembro del equipo',
            'equipo' => 'Debes completar el equipo al que pertenece el miembro',
        ]);

        if($id) {
            $equipo=Equipo::findOrFail($id);
        } else {
            $equipo=new Equipo;
            $equipo->ordenar();
        }

        $equipo->fill($request->all())
            ->subir($request->file('imagen'),'imagen')
            ->save();

        if($id) {
            Flasher::set("El miembro del equipo fue modificado exitosamente.", 'Miembro Editado', 'success')->flashear();
            return back();
        } else {
            Flasher::set("El miembro del equipo fue creado exitosamente.", 'Miembro Creado', 'success')->flashear();
            return redirect()->route('equipos');
        }
    }

    public function ordenar(Request $request)
    {
        $ids = $request->all()['ids'];
        $orden = 1;
        foreach($ids as $id) {
            Equipo::where('id', $id)->update(['orden' => $orden]);
            $orden += 1;
        }
        return ['ok'=>true];
    }

    public function visibilidad(Equipo $equipo)
    {
        return $this->cambiarVisibilidad($equipo);
    }
}