<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

class Localizacion extends Controller
{
	public function cambiarIdioma($idioma)
	{
		App::setLocale($idioma);
		session()->put('idioma', $idioma);
		return back();
	}
}
