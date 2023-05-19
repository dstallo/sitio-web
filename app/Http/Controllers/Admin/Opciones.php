<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\AxysListado as Listado;
use App\Models\Opcion;
use App\Models\Pregunta;
use App\Models\Encuesta;

class Opciones extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Encuesta $encuesta, Pregunta $pregunta, Request $request)
	{
		$query = $pregunta->opciones();

		$listado = new Listado(
			'opciones_' . $pregunta->id,
			$query,
			$request,
			[],
			[
				'buscando' => [
					['campo' => 'valor_es', 'comparacion' => 'like'],
				],
				'buscando_id' => [
					['campo' => 'id', 'comparacion' => 'igual']
				]
			]
		);

		//$opciones=$listado->paginar(50);
		$opciones = $listado->get();

		return view('admin.opciones.index', compact('opciones', 'listado', 'pregunta', 'encuesta'));
	}

	public function eliminar(Encuesta $encuesta, Pregunta $pregunta, Opcion $opcion)
	{
		try {
			$opcion->delete();
			$flasher = Flasher::set('La opción fue eliminada.', 'Opción Eliminada', 'success');
		} catch (\Exception $e) {
			$flasher = Flasher::set('No se pudo borrar la opción, ya tiene contenido asociado.', 'Error', 'error');
		}
		$flasher->flashear();
		return redirect()->back();
	}

	public function crear(Encuesta $encuesta, Pregunta $pregunta, Request $request)
	{
		$opcion = new Opcion();

		return view('admin.opciones.crear', compact('opcion', 'pregunta', 'encuesta'));
	}

	public function editar(Encuesta $encuesta, Pregunta $pregunta, Opcion $opcion, Request $request)
	{
		return view('admin.opciones.editar', compact('opcion', 'pregunta', 'encuesta'));
	}

	public function guardar(Encuesta $encuesta, Pregunta $pregunta, $id = null, Request $request)
	{
		$this->validate($request, [
			'valor_es' => 'required',
		]);

		if ($id) {
			$opcion = Opcion::findOrFail($id);
		} else {
			$opcion = new Opcion();
			$opcion->id_pregunta = $pregunta->id;
			$opcion->ordenar([['id_pregunta', $pregunta->id]]);
		}

		$opcion->fill($request->all())
			->save();

		if ($id) {
			Flasher::set('La opción fue modificada exitosamente.', 'Opción Editada', 'success')->flashear();
			return back();
		} else {
			Flasher::set('La opción fue creada exitosamente.', 'Opción Creada', 'success')->flashear();
			return redirect()->route('opciones', [$encuesta, $pregunta]);
		}
	}

	public function ordenar(Encuesta $encuesta, Pregunta $pregunta, Request $request)
	{
		$ids = $request->all()['ids'];
		$orden = 1;
		foreach ($ids as $id) {
			$pregunta->opciones()->where('id', $id)->update(['orden' => $orden]);
			$orden += 1;
		}
		return ['ok' => true];
	}
}
