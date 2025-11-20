<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\AxysListado as Listado;
use App\Axys\Traits\TieneVisibilidad;
use App\Models\Evento;
use Closure;

class Agenda extends Controller
{
	use TieneVisibilidad;

	public function __construct()
	{
		$this->middleware('auth');
		//$this->middleware('rol.admin');
	}

	public function index(Request $request)
	{
		$query = Evento::query();

		if (!session()->has('axys.listado.eventos.orden')) {
			session(['axys.listado.eventos.orden' => 'fecha']);
			session(['axys.listado.eventos.sentido' => 'desc']);
		}

		$listado = new Listado(
			'eventos',
			$query,
			$request,
			['id', 'titulo_es', 'fecha'],
			[
				'buscando' => [
					['campo' => 'titulo_es', 'comparacion' => 'like'],
				],
				'buscando_id' => [
					['campo' => 'id', 'comparacion' => 'igual']
				],
			]
		);

		$agenda = $listado->paginar(50);

		return view('admin.agenda.index', compact('agenda', 'listado'));
	}

	public function eliminar(Evento $evento)
	{
		try {
			$evento->delete();
			$flasher = Flasher::set('El evento fue eliminado.', 'Evento Eliminado', 'success');
		} catch (\Exception $e) {
			$flasher = Flasher::set('No se pudo borrar el evento.', 'Error', 'error');
		}
		$flasher->flashear();
		return redirect()->back();
	}

	public function crear(Request $request)
	{
		$evento = new Evento();

		return view('admin.agenda.crear', compact('evento'));
	}

	public function editar(Evento $evento, Request $request)
	{
		return view('admin.agenda.editar', compact('evento'));
	}

	public function guardar(Request $request, $id = null)
	{
		$this->validate($request, [
			'titulo_es' => ['required'],
			'link' => 'nullable|url',
			'fecha'=> 'nullable|date'
		]);

		if ($id) {
			$evento = Evento::findOrFail($id);
		} else {
			$evento = new Evento();
		}

		$evento->fill($request->all());

		$evento->save();

		if ($id) {
			Flasher::set('El evento fue modificado exitosamente.', 'Evento Editado', 'success')->flashear();
			return back();
		} else {
			Flasher::set('El evento fue creado exitosamente.', 'Evento Creado', 'success')->flashear();
			return redirect()->route('editar_evento', $evento);
		}
	}

	public function visibilidad(Evento $evento)
	{
		return $this->cambiarVisibilidad($evento);
	}
}
