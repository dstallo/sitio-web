<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\AxysListado as Listado;
use App\Axys\Traits\TieneVisibilidad;
use App\Models\Sucursal;
use Closure;

class Sucursales extends Controller
{
	use TieneVisibilidad;

	public function __construct()
	{
		$this->middleware('auth');
		//$this->middleware('rol.admin');
	}

	public function index(Request $request)
	{
		$query = Sucursal::query();

		if (!session()->has('axys.listado.sucursales.orden')) {
			session(['axys.listado.sucursales.orden' => 'id']);
			session(['axys.listado.sucursales.sentido' => 'desc']);
		}

		$listado = new Listado(
			'sucursales',
			$query,
			$request,
			['id', 'nombre'],
			[
				'buscando' => [
					['campo' => 'nombre', 'comparacion' => 'like'],
				],
				'buscando_id' => [
					['campo' => 'id', 'comparacion' => 'igual']
				],
			]
		);

		$sucursales = $listado->paginar(50);

		return view('admin.sucursales.index', compact('sucursales', 'listado'));
	}

	public function eliminar(Sucursal $sucursal)
	{
		try {
			$sucursal->delete();
			$flasher = Flasher::set('La página fue eliminada.', 'Página Eliminada', 'success');
		} catch (\Exception $e) {
			$flasher = Flasher::set('No se pudo borrar la página, ya tiene contenido asociado.', 'Error', 'error');
		}
		$flasher->flashear();
		return redirect()->back();
	}

	public function crear(Request $request)
	{
		$sucursal = new Sucursal();

		return view('admin.sucursales.crear', compact('sucursal'));
	}

	public function editar(Sucursal $sucursal, Request $request)
	{
		return view('admin.sucursales.editar', compact('sucursal'));
	}

	public function guardar(Request $request, $id = null)
	{
		$this->validate($request, [
			'nombre' => ['required'],
			'link' => 'nullable|url',
			'thumbnail' => 'nullable|file|mimes:jpg,png|max:512',
		]);

		if ($id) {
			$sucursal = Sucursal::findOrFail($id);
		} else {
			$sucursal = new Sucursal();
		}

		$sucursal->fill($request->all());

		$sucursal->subir($request->file('thumbnail'), 'thumbnail')
			->save();

		if ($id) {
			Flasher::set('El centro fue modificado exitosamente.', 'Centro Editado', 'success')->flashear();
			return back();
		} else {
			Flasher::set('El centro fue creado exitosamente.', 'Centro Creado', 'success')->flashear();
			return redirect()->route('editar_sucursal', $sucursal);
		}
	}

	public function visibilidad(Sucursal $sucursal)
	{
		return $this->cambiarVisibilidad($sucursal);
	}

	public function eliminarArchivo(Sucursal $sucursal, $campo)
	{
		$sucursal->eliminarArchivo($campo)->save();
		Flasher::set("Se eliminó el archivo $campo", 'Archivo Eliminado', 'success')->flashear();
		return back();
	}
}
