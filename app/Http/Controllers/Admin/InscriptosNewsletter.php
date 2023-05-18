<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\AxysListado as Listado;
use Illuminate\Support\Facades\Response;

use App\Models\InscriptoNewsletter as Inscripto;

class InscriptosNewsletter extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $input)
    {
        //le inyecto un ordenamiento (id desc)
        if(!\Cache::has("axys.listado.inscriptos_newsletter.orden")) {
            cache(["axys.listado.inscriptos_newsletter.orden" => 'id'], 30);
            cache(["axys.listado.inscriptos_newsletter.sentido" => 'desc'], 30);
        }

        $listado=new Listado(
        	'inscriptos_newsletter',
            Inscripto::query(),
            $input,
            ['id','created_at','email'],
            [
            	'buscando'	=>[
                    ['campo'=>'email','comparacion'=>'like'],
            	],
            	'buscando_id' =>[
            		['campo'=>'id','comparacion'=>'igual']
            	]
            ]
        );
        
        $inscriptos=$listado->paginar();

        return view('admin.newsletter.index', compact('inscriptos', 'listado'));
    }

    public function eliminar(Inscripto $inscripto)
    {
        $id=$inscripto->id;
        try {
            $inscripto->delete();
            $flasher=Flasher::set("El inscripto #$id fue eliminado.", 'Inscripto Eliminado', 'success');
        } catch (\Exception $e) {
            $inscripto=Flasher::set('Ocurrió un error al eliminar al inscripto.', 'Error', 'error');
        }
        $flasher->flashear();
        return redirect()->back();
    }

    public function editar(Inscripto $inscripto)
    {
        return view('admin.newsletter.editar',compact('inscripto'));
    }

    public function guardar(Request $input, $id=null)
    {
        $this->validate($input, [
            'email' => 'required|email',
        ]);
        
        $inscripto=Inscripto::findOrFail($id);
        $inscripto->fill($input->all());
        $inscripto->save();
        Flasher::set("El inscripto #$inscripto->id fue modificado exitosamente.", 'Inscripto Editado', 'success')->flashear();
        
        return redirect()->route('inscriptos_newsletter');
    }

    public function exportar()
    {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=" . date('Y-m-d') . "-inscriptos_newsletter.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $inscriptos = Inscripto::all();
        $columnas = ['ID', 'Fecha', 'Email'];

        $callback = function() use ($inscriptos, $columnas)
        {
            $archivo = fopen('php://output', 'w');
            fputcsv($archivo, $columnas);

            foreach($inscriptos as $inscripto) {
                fputcsv($archivo, [
                    $inscripto->id,
                    $inscripto->fecha_inscripcion,
                    $inscripto->email,
                ]);
            }
            fclose($archivo);
        };
        
        return Response::stream($callback, 200, $headers);
    }
}