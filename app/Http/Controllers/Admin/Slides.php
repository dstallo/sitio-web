<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\AxysListado as Listado;
use App\Axys\Traits\TieneVisibilidad;
use App\Models\Slide;

class Slides extends Controller
{
	use TieneVisibilidad;

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
		$query = Slide::orderBy('orden');

		$listado = new Listado(
			'slides',
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

		//$slides=$listado->paginar(50);
		$slides = $listado->get();

		return view('admin.slides.index', compact('slides', 'listado'));
	}

	public function eliminar(Slide $slide)
	{
		try {
			$slide->delete();
			$flasher = Flasher::set('El slide fue eliminado.', 'Slide Eliminado', 'success');
		} catch (\Exception $e) {
			$flasher = Flasher::set('No se pudo borrar el slide, ya tiene contenido asociado.', 'Error', 'error');
		}
		$flasher->flashear();
		return redirect()->back();
	}

	public function eliminarArchivo(Slide $slide, $campo)
	{
		$slide->eliminarArchivo($campo)->save();
		Flasher::set("Se eliminó el archivo $campo", 'Archivo Eliminado', 'success')->flashear();
		return back();
	}

	public function crear(Request $request)
	{
		$slide = new Slide();

		return view('admin.slides.crear', compact('slide'));
	}

	public function editar(Slide $slide, Request $request)
	{
		return view('admin.slides.editar', compact('slide'));
	}

	public function guardar(Request $request, $id = null)
	{
		$this->validate($request, [
			'titulo_es' => 'required',
			'imagen' => 'file|mimes:jpg,png|max:1024',
			'imagen_vertical' => 'file|mimes:jpg,png|max:1024'
		]);

		if ($id) {
			$slide = Slide::findOrFail($id);
		} else {
			$slide = new Slide();
			$slide->ordenar();
		}

		$slide->fill($request->all())
			->subir($request->file('imagen'), 'imagen')
			->subir($request->file('imagen_vertical'), 'imagen_vertical')
			->save();

		if ($id) {
			Flasher::set('El slide fue modificado exitosamente.', 'Slide Editado', 'success')->flashear();
			return back();
		} else {
			Flasher::set('El slide fue creado exitosamente.', 'Slide Creado', 'success')->flashear();
			return redirect()->route('slides');
		}
	}

	public function ordenar(Request $request)
	{
		$ids = $request->all()['ids'];
		$orden = 1;
		foreach ($ids as $id) {
			Slide::where('id', $id)->update(['orden' => $orden]);
			$orden += 1;
		}
		return ['ok' => true];
	}

	public function visibilidad(Slide $slide)
	{
		return $this->cambiarVisibilidad($slide);
	}
}
