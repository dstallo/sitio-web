<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\AxysListado as Listado;
use App\Axys\Traits\TieneVisibilidad;
use App\Models\Publicacion;

class Publicaciones extends Controller
{
	use TieneVisibilidad;

	public function __construct()
	{
		$this->middleware('auth');
		//$this->middleware('rol.admin');
	}

	public function index(Request $request)
	{
		$query = Publicacion::query();

		if (!session()->has('axys.listado.publicaciones.orden')) {
			session(['axys.listado.publicaciones.orden' => 'orden']);
			session(['axys.listado.publicaciones.sentido' => 'asc']);
		}

		$listado = new Listado(
			'publicaciones',
			$query,
			$request,
			['orden', 'id', 'titulo_es'],
			[
				'buscando' => [
					['campo' => 'titulo_es', 'comparacion' => 'like'],
				],
				'buscando_id' => [
					['campo' => 'id', 'comparacion' => 'igual']
				],
			]
		);

		$publicaciones = $listado->paginar(50);

		return view('admin.publicaciones.index', compact('publicaciones', 'listado'));
	}

	public function eliminar(Publicacion $publicacion)
	{
		try {
			$publicacion->ficha?->delete();
			$publicacion->delete();
			$flasher = Flasher::set('La publicación fue eliminada.', 'Publicación Eliminada', 'success');
		} catch (\Exception $e) {
			$flasher = Flasher::set('No se pudo borrar la publicación.', 'Error', 'error');
		}
		$flasher->flashear();
		return redirect()->back();
	}

	public function crear(Request $request)
	{
		$publicacion = new Publicacion();

		return view('admin.publicaciones.crear', compact('publicacion'));
	}

	public function editar(Publicacion $publicacion, Request $request)
	{
		return view('admin.publicaciones.editar', compact('publicacion'));
	}

	public function guardar(Request $request, $id = null)
	{
		$this->validate($request, [
			'titulo_es' => 'required',
			'link' => 'nullable|url',
			'thumbnail' => ['nullable', 'file', 'mimes:'.config('app.image_mimes'),'max:'.config('app.image_size')],
		]);

		if ($id) {
			$publicacion = Publicacion::findOrFail($id);
		} else {
			$publicacion = new Publicacion();
		}

		$publicacion->fill($request->all());

        $publicacion->destacado = !! $request->input('destacado');

        $publicacion->subir($request->file('thumbnail'), 'thumbnail')->save();

        $publicacion->guardarFicha($request);

		if ($id) {
			Flasher::set('La publicación fue modificada exitosamente.', 'Publicación Editada', 'success')->flashear();
			return back();
		} else {
			Flasher::set('La publicación fue creada exitosamente.', 'Publicación Creada', 'success')->flashear();
			return redirect()->route('editar_publicacion', $publicacion);
		}
	}

    public function ordenar(Request $request)
	{
		$ids = $request->all()['ids'];
		$orden = 1;
		foreach ($ids as $id) {
			Publicacion::where('id', $id)->update(['orden' => $orden]);
			$orden += 1;
		}
		return ['ok' => true];
	}

	public function visibilidad(Publicacion $publicacion)
	{
		return $this->cambiarVisibilidad($publicacion);
	}

	public function eliminarArchivo(Publicacion $publicacion, $campo)
	{
		$publicacion->eliminarArchivo($campo)->save();
		Flasher::set("Se eliminó la imagen", 'Imagen Eliminada', 'success')->flashear();
		return back();
	}
}
