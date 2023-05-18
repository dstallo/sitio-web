<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\AxysListado as Listado;
use Illuminate\Support\Facades\Response;

use App\Models\Consulta;

class Consultas extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Consulta::orderBy('id', 'desc');

        $listado=new Listado(
            'consultas',
            $query,
            $request,
            [],
            [
                'buscando'  =>[
                    ['campo'=>'nombre','comparacion'=>'like'],
                    ['campo'=>'email','comparacion'=>'like'],
                    ['campo'=>'mensaje','comparacion'=>'like'],
                ],
                'buscando_id' =>[
                    ['campo'=>'id','comparacion'=>'igual']
                ],
                'buscando_vista' => [
                    ['campo'=>'vista','comparacion'=>'igual']
                ]
            ]
        );
        
        $consultas=$listado->paginar(50);
        //$consultas=$listado->get();

        return view('admin.consultas.index', compact('consultas', 'listado'));
    }

    public function eliminar(Consulta $consulta)
    {
        try {
            $consulta->delete();
            $flasher=Flasher::set("La consulta fue eliminada.", 'Consulta Eliminada', 'success');
        } catch (\Exception $e) {
            $flasher=Flasher::set('No se pudo borrar la consulta, ya tiene contenido asociado.', 'Error', 'error');
        }
        $flasher->flashear();
        return redirect()->back();
    }

    public function eliminarArchivo(Consulta $consulta, $campo)
    {
        $consulta->eliminarArchivo($campo)->save();
        Flasher::set("Se eliminó el archivo $campo", 'Archivo Eliminado', 'success')->flashear();
        return back();
    }

    public function crear(Request $request)
    {
        $consulta = new Consulta;

        return view('admin.consultas.crear',compact('consulta'));
    }

    public function editar(Consulta $consulta, Request $request)
    {
        $consulta->vista = true;
        $consulta->save();
        return view('admin.consultas.editar',compact('consulta'));
    }

    public function desver(Consulta $consulta)
    {
        $consulta->vista = false;
        $consulta->save();
        return redirect()->route('consultas');
    }

    public function guardar(Request $request, $id=null)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'email' => 'email',
        ]);

        if($id) {
            $consulta=Consulta::findOrFail($id);
        } else {
            $consulta=new Consulta;
            $consulta->vista = true;
        }

        $consulta->fill($request->all())
            ->save();

        if($id) {
            Flasher::set("La consulta fue modificada exitosamente.", 'Consulta Editada', 'success')->flashear();
            return back();
        } else {
            Flasher::set("La consulta fue creada exitosamente.", 'Consulta Creada', 'success')->flashear();
            return redirect()->route('consultas');
        }
    }

    public function exportar()
    {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=" . date('Y-m-d') . "-consultas.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $consultas = Consulta::orderBy('id', 'desc')->get();
        $columnas = ['ID', 'Fecha', 'Nombre', 'Email', 'Teléfono', 'Mensaje'];

        $callback = function() use ($consultas, $columnas)
        {
            $archivo = fopen('php://output', 'w');
            fputcsv($archivo, $columnas);

            foreach($consultas as $consulta) {
                fputcsv($archivo, [
                    $consulta->id,
                    $consulta->fecha,
                    $consulta->nombre,
                    $consulta->email,
                    $consulta->telefono,
                    $consulta->mensaje,
                ]);
            }
            fclose($archivo);
        };
        
        return Response::stream($callback, 200, $headers);
    }
}