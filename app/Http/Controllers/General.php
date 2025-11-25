<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\Novedades;
use App\Models\Popup;
use App\Models\Slide;
use App\Models\Novedad;
use App\Models\Consulta;
use App\Models\Contacto;
use App\Models\Encuesta;
use App\Models\Servicio;
use App\Models\Contenido;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Notifications\NuevaConsulta;
use Illuminate\Support\Facades\Validator;
use App\Models\InscriptoNewsletter as Inscripto;
use App\Models\Pagina;
use App\Models\Publicacion;
use App\Models\Sucursal;

class General extends Controller
{
	public function home()
	{
		$slides = Slide::front()->get();
		$servicios = Servicio::front()->get();
		$novedades = Novedad::front()->where('destacado', true)->get();
        $paginas = Pagina::front()->get();
		$contenidos = Contenido::front()->get();
		$popup = Popup::where('visible', true)->orderBy('id', 'desc')->first();
        $agenda = Evento::front()->get();

        $publicaciones = Publicacion::front()->where('destacado', true)->get();

		return view('home', compact('agenda', 'paginas', 'slides', 'servicios', 'novedades', 'contenidos', 'popup', 'publicaciones'));
	}

    public function novedades()
	{
        $novedades = Novedad::front()->get();
        $paginas = Pagina::front()->get();

		return view('novedades', compact('novedades', 'paginas'));
	}

    public function publicaciones()
	{
        $publicaciones = Publicacion::front()->get();
        $paginas = Pagina::front()->get();

		return view('publicaciones', compact('publicaciones', 'paginas'));
	}

	public function novedad(Novedad $novedad, $titulo)
	{
		$ficha = $novedad->ficha;
        $paginas = Pagina::front()->get();

		return view('ficha', compact('ficha', 'paginas'));
	}

	public function servicio(Servicio $servicio, $titulo)
	{
		$ficha = $servicio->ficha;
        $paginas = Pagina::front()->get();

		return view('ficha', compact('ficha', 'paginas'));
	}

    public function pagina(Pagina $pagina)
	{
		$ficha = $pagina->ficha;
        $paginas = Pagina::front()->get();

		return view('ficha', compact('ficha', 'paginas'));
	}

    public function publicacion(Publicacion $publicacion)
	{
		$ficha = $publicacion->ficha;
        $paginas = Pagina::front()->get();

		return view('ficha', compact('ficha', 'paginas'));
	}

    public function sucursales()
	{
        $sucursales = Sucursal::front()->get();
        $paginas = Pagina::front()->get();

		return view('sucursales', compact('sucursales', 'paginas'));
	}

	public function newsletter(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'email' => 'required|email',
		]);

		if ($validator->fails()) {
			return response(['ok' => false, 'errores' => $validator->errors()->all()], 200);
		}

		if (!Inscripto::where('email', $request->get('email'))->first()) {
			$inscripto = new Inscripto($request->all());
			$inscripto->save();
		}

		return response(['ok' => true], 200);
	}

	public function consultar(Request $request)
	{
		$this->validate($request, [
			'nombre' => 'required',
			'email' => 'required|email',
			'mensaje' => 'required',
		]);
        
		if (!validar_recaptcha($request)) {
			return redirect(URL::previous() . '#consulta')->withErrors(['captcha' => __('textos.consulta.errores.captcha')])
				->withInput($request->all());
		}
        
		$consulta = new Consulta();
		$consulta->fill($request->all());
		$consulta->save();
        
		$contacto = new Contacto();
		if ($contacto->email) {
			$contacto->notify(new NuevaConsulta($consulta));
		}
        
		return redirect('/consulta-enviada');
	}

	public function consultaEnviada()
	{
        $paginas = Pagina::front()->get();
		return view('consulta-enviada', compact('paginas'));
	}

	public function verEncuesta()
	{
		$encuesta = Encuesta::where('visible', true)->orderBy('id', 'desc')
			->with(['preguntas', 'preguntas.opciones'])
			->first();
		if (!$encuesta) {
			abort(404);
		}

		if (session()->get('encuesta-votada')) {
			return redirect('encuesta-completa');
		}

        $paginas = Pagina::front()->get();

		return view('encuesta', compact('encuesta', 'paginas'));
	}

	public function votarEncuesta(Request $request)
	{
		$encuesta = Encuesta::where('visible', true)->orderBy('id', 'desc')
			->with(['preguntas', 'preguntas.opciones'])
			->first();
		if (!$encuesta) {
			abort(404);
		}

		//procesar voto
		if (!session()->get('encuesta-votada')) {
			foreach ($encuesta->preguntas as $pregunta) {
				$id_opcion = $request->input('pregunta_' . $pregunta->id);
				$pregunta->opciones()->where('id', $id_opcion)->update([
					'votos' => DB::raw('votos + 1')
				]);
			}

			session()->put(['encuesta-votada' => true]);
		}

		return redirect('/encuesta-completa');
	}

	public function encuestaCompleta()
	{
        $paginas = Pagina::front()->get();
		return view('encuesta-completa', compact('paginas'));
	}
}
