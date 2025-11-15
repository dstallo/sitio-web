<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\AxysListado as Listado;
use App\Axys\Traits\TieneVisibilidad;
use App\Models\Pagina;
use Closure;

class Paginas extends Controller
{
	use TieneVisibilidad;

	public function __construct()
	{
		$this->middleware('auth');
		//$this->middleware('rol.admin');
	}

	public function index(Request $request)
	{
		$query = Pagina::query();

		if (!session()->has('axys.listado.paginas.orden')) {
			session(['axys.listado.paginas.orden' => 'id']);
			session(['axys.listado.paginas.sentido' => 'desc']);
		}

		$listado = new Listado(
			'paginas',
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

		$paginas = $listado->paginar(50);

		return view('admin.paginas.index', compact('paginas', 'listado'));
	}

	public function eliminar(Pagina $pagina)
	{
		try {
			foreach ($pagina->contenidos as $contenido) {
				$contenido->delete();
			} //borrar todo el contenido multimedia
			$pagina->delete();
			$flasher = Flasher::set('La página fue eliminada.', 'Página Eliminada', 'success');
		} catch (\Exception $e) {
			$flasher = Flasher::set('No se pudo borrar la página, ya tiene contenido asociado.', 'Error', 'error');
		}
		$flasher->flashear();
		return redirect()->back();
	}

	public function crear(Request $request)
	{
		$pagina = new Pagina();

		return view('admin.paginas.crear', compact('pagina'));
	}

	public function editar(Pagina $pagina, Request $request)
	{
		return view('admin.paginas.editar', compact('pagina'));
	}

	public function guardar(Request $request, $id = null)
	{
		$this->validate($request, [
			'titulo_es' => ['required', function($attribute, $value, $fail) use ($id) {
                $query = Pagina::where('slug', Str::slug($value));
                
                if ($id)
                    $query->where('id', '!=', $id);

                if ($query->first()) {
                    $fail("Ya existe una página con este título");
                }
            }],
			'link' => 'nullable|url',
			'thumbnail' => 'nullable|file|mimes:jpg,png|max:512',
		]);

		if ($id) {
			$pagina = Pagina::findOrFail($id);
		} else {
			$pagina = new Pagina();
		}

		$pagina->fill($request->all());

        $pagina->slug = Str::slug($pagina->titulo_es);

		$pagina->subir($request->file('thumbnail'), 'thumbnail')
			->save();
        
        $pagina->guardarFicha($request);

		if ($id) {
			Flasher::set('La página fue modificada exitosamente.', 'Página Editada', 'success')->flashear();
			return back();
		} else {
			Flasher::set('La página fue creada exitosamente.', 'Página Creada', 'success')->flashear();
			return redirect()->route('editar_pagina', $pagina);
		}
	}

	public function visibilidad(Pagina $pagina)
	{
		return $this->cambiarVisibilidad($pagina);
	}

	public function eliminarArchivo(Pagina $pagina, $campo)
	{
		$pagina->eliminarArchivo($campo)->save();
		Flasher::set("Se eliminó el archivo $campo", 'Archivo Eliminado', 'success')->flashear();
		return back();
	}
}
