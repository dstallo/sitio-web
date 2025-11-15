<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\AxysListado as Listado;
use App\Axys\Traits\TieneVisibilidad;
use App\Models\Servicio;

class Servicios extends Controller
{
	use TieneVisibilidad;

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
		$query = Servicio::orderBy('orden');

		$listado = new Listado(
			'servicios',
			$query,
			$request,
			[],
			[
				'buscando' => [
					['campo' => 'titulo_es', 'comparacion' => 'like'],
				],
				'buscando_id' => [
					['campo' => 'id', 'comparacion' => 'igual']
				]
			]
		);

		//$servicios=$listado->paginar(50);
		$servicios = $listado->get();

		return view('admin.servicios.index', compact('servicios', 'listado'));
	}

	public function eliminar(Servicio $servicio)
	{
		try {
			$servicio->delete();
			$flasher = Flasher::set('El servicio fue eliminado.', 'Servicio Eliminado', 'success');
		} catch (\Exception $e) {
			$flasher = Flasher::set('No se pudo borrar el servicio, ya tiene contenido asociado.', 'Error', 'error');
		}
		$flasher->flashear();
		return redirect()->back();
	}

	public function eliminarArchivo(Servicio $servicio, $campo)
	{
		$servicio->eliminarArchivo($campo)->save();
		Flasher::set("Se eliminó el archivo $campo", 'Archivo Eliminado', 'success')->flashear();
		return back();
	}

	public function crear(Request $request)
	{
		$servicio = new Servicio();

		return view('admin.servicios.crear', compact('servicio'));
	}

	public function editar(Servicio $servicio, Request $request)
	{
		return view('admin.servicios.editar', compact('servicio'));
	}

	public function guardar(Request $request, $id = null)
	{
		$this->validate($request, [
			'titulo_es' => 'required',
			'link' => 'nullable|url',
			'imagen' => 'file|mimes:png,svg|max:1024',
		]);

		if ($id) {
			$servicio = Servicio::findOrFail($id);
		} else {
			$servicio = new Servicio();
			$servicio->ordenar();
		}

		$servicio->fill($request->all())
			->subir($request->file('imagen'), 'imagen')
			->save();

        $servicio->guardarFicha($request);

		if ($id) {
			Flasher::set('El servicio fue modificado exitosamente.', 'Servicio Editado', 'success')->flashear();
			return back();
		} else {
			Flasher::set('El servicio fue creado exitosamente.', 'Servicio Creado', 'success')->flashear();
			return redirect()->route('editar_servicio', $servicio);
		}
	}

	public function ordenar(Request $request)
	{
		$ids = $request->all()['ids'];
		$orden = 1;
		foreach ($ids as $id) {
			Servicio::where('id', $id)->update(['orden' => $orden]);
			$orden += 1;
		}
		return ['ok' => true];
	}

	public function visibilidad(Servicio $servicio)
	{
		return $this->cambiarVisibilidad($servicio);
	}
}
