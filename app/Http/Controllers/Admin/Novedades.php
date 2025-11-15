<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\AxysListado as Listado;
use App\Axys\Traits\TieneVisibilidad;
use App\Models\Novedad;

class Novedades extends Controller
{
	use TieneVisibilidad;

	public function __construct()
	{
		$this->middleware('auth');
		//$this->middleware('rol.admin');
	}

	public function index(Request $request)
	{
		$query = Novedad::query();

		if (!session()->has('axys.listado.novedades.orden')) {
			session(['axys.listado.novedades.orden' => 'id']);
			session(['axys.listado.novedades.sentido' => 'desc']);
		}

		$listado = new Listado(
			'novedades',
			$query,
			$request,
			['id', 'titulo_es'],
			[
				'buscando' => [
					['campo' => 'titulo_es', 'comparacion' => 'like'],
				],
				'buscando_id' => [
					['campo' => 'id', 'comparacion' => 'igual']
				],
			]
		);

		$novedades = $listado->paginar(50);

		return view('admin.novedades.index', compact('novedades', 'listado'));
	}

	public function eliminar(Novedad $novedad)
	{
		try {
			foreach ($novedad->contenidos as $contenido) {
				$contenido->delete();
			} //borrar todo el contenido multimedia
			$novedad->delete();
			$flasher = Flasher::set('La novedad fue eliminada.', 'Novedad Eliminada', 'success');
		} catch (\Exception $e) {
			$flasher = Flasher::set('No se pudo borrar la novedad, ya tiene contenido asociado.', 'Error', 'error');
		}
		$flasher->flashear();
		return redirect()->back();
	}

	public function crear(Request $request)
	{
		$novedad = new Novedad();

		return view('admin.novedades.crear', compact('novedad'));
	}

	public function editar(Novedad $novedad, Request $request)
	{
		return view('admin.novedades.editar', compact('novedad'));
	}

	public function guardar(Request $request, $id = null)
	{
		$this->validate($request, [
			'titulo_es' => 'required',
			'link' => 'nullable|url',
			'thumbnail' => 'nullable|file|mimes:jpg,png|max:512',
		]);

		if ($id) {
			$novedad = Novedad::findOrFail($id);
		} else {
			$novedad = new Novedad();
		}

		$novedad->fill($request->all());

        $novedad->subir($request->file('thumbnail'), 'thumbnail')->save();

        $novedad->guardarFicha($request);

		if ($id) {
			Flasher::set('La novedad fue modificada exitosamente.', 'Novedad Editada', 'success')->flashear();
			return back();
		} else {
			Flasher::set('La novedad fue creada exitosamente.', 'Novedad Creada', 'success')->flashear();
			return redirect()->route('editar_novedad', $novedad);
		}
	}

	public function visibilidad(Novedad $novedad)
	{
		return $this->cambiarVisibilidad($novedad);
	}

	public function eliminarArchivo(Novedad $novedad, $campo)
	{
		$novedad->eliminarArchivo($campo)->save();
		Flasher::set("Se eliminó el archivo $campo", 'Archivo Eliminado', 'success')->flashear();
		return back();
	}
}
