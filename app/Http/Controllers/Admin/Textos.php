<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\AxysListado as Listado;
use App\Axys\Traits\TieneVisibilidad;

use App\Models\Texto;

class Textos extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Texto::orderBy('id', 'asc');

        $listado=new Listado(
            'textos',
            $query,
            $request,
            [],
            [
                'buscando'  =>[
                    ['campo'=>'texto','comparacion'=>'like'],
                ],
                'buscando_id' =>[
                    ['campo'=>'id','comparacion'=>'like']
                ]
            ]
        );
        
        $textos=$listado->get();

        return view('admin.textos.index', compact('textos', 'listado'));
    }

    public function editar(Texto $texto, Request $request)
    {
        return view('admin.textos.editar',compact('texto'));
    }

    public function guardar(Request $request, $id=null)
    {
        $this->validate($request, []);

        $texto=Texto::findOrFail($id);
        
        $texto->fill($request->all())->save();

        Flasher::set("El texto fue modificado exitosamente.", 'Texto Editado', 'success')->flashear();
        return back();
        
    }
}