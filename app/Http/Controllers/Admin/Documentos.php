<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\Traits\TieneVisibilidad;
use Illuminate\Support\Facades\Validator;

use App\Models\Ficha;
use App\Models\Documento;

class Documentos extends Controller
{
    use TieneVisibilidad;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, ?Ficha $ficha = null)
    {
        if (! $ficha)
            abort(404);

        if ($ficha)
            $documentos = $ficha->documentos;
        else
            $documentos = Documento::whereNull('id_ficha')->orderBy('orden')->get();

        return view('admin.documentos.index', compact('ficha', 'documentos'));
    }

    public function eliminar(Request $request, ?Ficha $ficha = null, Documento $documento)
    {
        try {
            $documento->delete();
            $flasher=Flasher::set("El documento fue eliminado.", 'Documento Eliminado', 'success');
        } catch (\Exception $e) {
            $flasher=Flasher::set('No se pudo borrar el documento.', 'Error', 'error');
        }
        $flasher->flashear();
        return redirect()->back();
    }

    public function subirArchivo(Request $request, ?Ficha $ficha = null)
    {
        if (! $ficha)
            abort(404);
        // Si se tiene que modificar el mime, debe cambiarse también la lista en la función guardar y en la vista del listado de documentos para dropzone.
        $validator = Validator::make($request->all(), [
            'archivo' => 'required|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,csv,zip',
        ]);
        if ($validator->fails()) {
            return response($validator->messages()->all()[0] ?? "Ocurrió un error al subir el archivo", 422);
        }

        $documento=(new Documento)
            ->subir($request->file('archivo'), 'archivo')
            ->ordenar($ficha ? [['id_ficha', $ficha->id]] : []);

        $documento->tipo = $request->file('archivo')->getClientOriginalExtension();
        $documento->nombre = pathinfo($request->file('archivo')->getClientOriginalName(), PATHINFO_FILENAME);

        if ($ficha)
            $ficha->documentos()->save($documento);
        else
            $documento->save();
        
        return response('OK', 200);
    }

    public function editar(?Ficha $ficha = null, Documento $documento)
    {
        return view('admin.documentos.editar',compact('ficha', 'documento'));
    }

    public function guardar(Request $request, ?Ficha $ficha = null, Documento $documento)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'archivo' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,csv,zip',
        ]);

        $documento->fill($request->all());

        if ($request->file('archivo')) {
            $documento->tipo = $request->file('archivo')->getClientOriginalExtension();    
            $documento->subir($request->file('archivo'),'archivo');
        }
            
        $documento->ordenar($ficha ? [['id_ficha', $ficha->id]] : null)
            ->save();

        Flasher::set("El documento fue modificado exitosamente.", 'Documento Editado', 'success')->flashear();
        
        return back();
    }

    public function visibilidad(?Ficha $ficha = null, Documento $documento)
    {
        return $this->cambiarVisibilidad($documento);
    }

    public function eliminarArchivo(?Ficha $ficha = null, Documento $documento)
    {
        $documento->eliminarArchivo('archivo')->save();
        Flasher::set("Se eliminó el archivo", 'Archivo Eliminado', 'success')->flashear();
        return back();
    }

    public function ordenar(Request $request)
    {
        $ids = $request->all()['ids'];
        $orden = 1;
        foreach($ids as $id) {
            Documento::where('id', $id)->update(['orden' => $orden]);
            $orden += 1;
        }
        return ['ok'=>true];
    }
}