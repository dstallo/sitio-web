<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\AxysListado as Listado;
use App\Models\Pregunta;
use App\Models\Encuesta;

class Preguntas extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Encuesta $encuesta, Request $request)
	{
		$query = $encuesta->preguntas();

		$listado = new Listado(
			'preguntas_' . $encuesta->id,
			$query,
			$request,
			[],
			[
				'buscando' => [
					['campo' => 'pregunta_es', 'comparacion' => 'like'],
				],
				'buscando_id' => [
					['campo' => 'id', 'comparacion' => 'igual']
				]
			]
		);

		//$preguntas=$listado->paginar(50);
		$preguntas = $listado->get();

		return view('admin.preguntas.index', compact('preguntas', 'listado', 'encuesta'));
	}

	public function eliminar(Encuesta $encuesta, Pregunta $pregunta)
	{
		try {
			$pregunta->delete();
			$flasher = Flasher::set('La pregunta fue eliminada.', 'Pregunta Eliminada', 'success');
		} catch (\Exception $e) {
			$flasher = Flasher::set('No se pudo borrar la pregunta, ya tiene contenido asociado.', 'Error', 'error');
		}
		$flasher->flashear();
		return redirect()->back();
	}

	public function crear(Encuesta $encuesta, Request $request)
	{
		$pregunta = new Pregunta();

		return view('admin.preguntas.crear', compact('pregunta', 'encuesta'));
	}

	public function editar(Encuesta $encuesta, Pregunta $pregunta, Request $request)
	{
		return view('admin.preguntas.editar', compact('pregunta', 'encuesta'));
	}

	public function guardar(Request $request, Encuesta $encuesta, $id = null)
	{
		$this->validate($request, [
			'pregunta_es' => 'required',
		]);

		if ($id) {
			$pregunta = Pregunta::findOrFail($id);
		} else {
			$pregunta = new Pregunta();
			$pregunta->id_encuesta = $encuesta->id;
			$pregunta->ordenar([['id_encuesta', $encuesta->id]]);
		}

		$pregunta->fill($request->all())
			->save();

		if ($id) {
			Flasher::set('La pregunta fue modificada exitosamente.', 'Pregunta Editada', 'success')->flashear();
			return back();
		} else {
			Flasher::set('La pregunta fue creada exitosamente.', 'Pregunta Creada', 'success')->flashear();
			return redirect()->route('preguntas', [$encuesta]);
		}
	}

	public function ordenar(Encuesta $encuesta, Request $request)
	{
		$ids = $request->all()['ids'];
		$orden = 1;
		foreach ($ids as $id) {
			$encuesta->preguntas()->where('id', $id)->update(['orden' => $orden]);
			$orden += 1;
		}
		return ['ok' => true];
	}
}
