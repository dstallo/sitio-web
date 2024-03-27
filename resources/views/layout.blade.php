<?php
$tiene_servicios = App\Models\Servicio::front()->count();
$tiene_novedades = App\Models\Novedad::front()->count();
$tiene_contenidos = App\Models\Contenido::front()->count();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ url('icono.png') }}" />

    <meta name="description" content="Conciencia Astral" />
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <meta property="og:locale" content="es_AR" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="@yield('imagen', url('logo.png'))" />
    <meta property="og:title" content="@yield('titulo', config('app.name'))" />
    <meta property="og:description" content="@yield('bajada', 'Conciencia Astral')" />
    <meta property="og:url" content="{{ config('app.url') }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />

    <title>@yield('titulo', config('app.name'))</title>

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    @if(config('app.env') == 'production')

    @endif

    <script src="{{ mix('js/front.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

    <script src='https://www.google.com/recaptcha/api.js'></script>

    <link rel="stylesheet" type="text/css" href="{{ url('js/lib/slick/slick.css') }}">
    <script src="{{ url('js/lib/slick/slick.js') }}" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56e64ff5f19e592d" async="async"></script>

    <link href="{{ mix('css/front.css') }}" rel="stylesheet">
    
    @yield('script.header')
</head>
<body>
    @if(config('app.env') == 'production')
        
    @endif
    @include('flasher.flasher')
    
    <header>
        <div class="contenedor">
            <a href="{{ url('/') }}" class="logo">
                @if(!isset($ficha))
                    <h1>{{ config('app.name') }}</h1>
                @else
                    <h2>{{ config('app.name') }}</h2>
                @endif
            </a>
            <nav>
                <a class="desplegar-menu-principal"><span></span></a>
                <ul>
                @if ($tiene_servicios)
                    <li><a href="/#servicios">@lang('textos.menu.servicios')</a></li>
                @endif
                @if ($tiene_novedades)
                    <li><a href="/#novedades">@lang('textos.menu.novedades')</a></li>
                @endif
                @if ($tiene_contenidos)
                    <li><a href="/#galeria">@lang('textos.menu.galeria')</a></li>
                @endif
                    <li><a href="/#ubicacion">@lang('textos.menu.ubicacion')</a></li>
                    <li><a href="https://bit.ly/concienciaastral" target="_blank">@lang('textos.menu.inscripcion')</a></li>
                    <li><a href="/#consulta">@lang('textos.menu.contacto')</a></li>
                </ul>
            </nav>
            
            <div class="redes">
                <a class="idioma instagram" href="#"></a>
                <a class="idioma email" href="#"></a>
            </div>
        </div>
    </header>

    <div class="landing">
        @yield('contenido')

        <div class="ancla" id="ubicacion"></div>
        <section class="ubicacion contenedor">
            <h2>@lang('textos.ubicacion.titulo')</h2>
            <div class="intro">
                @lang('textos.ubicacion.texto')
            </div>
            <div class="mapa" id="mapa">
                <a href="https://maps.app.goo.gl/gMGWddbfxzzMhQpEA" target="_blank">
                    <img src="{{ url('img/mapa.jpg') }}" class="grande" alt="Mapa">
                    <img src="{{ url('img/mapa-chico.jpg') }}" class="chico" alt="Mapa">
                </a>
            </div>
            <?php /*
            <script>
                var mapa;
                function iniciarMapa() {
                    mapa = new google.maps.Map(
                        document.getElementById('mapa'), {zoom: 15, center: {lat: -34.462281902203145, lng: -58.86145648945509 }});

                    // google.maps.event.addListener(mapa, 'click', function(e) {
                    //     marcar(e.latLng);
                    // });
                    // marcador = new google.maps.Marker({
                    //     position: {lat: -34.462281902203145, lng: -58.86145648945509 }, 
                    //     map: mapa
                    // });
                }
            </script>
            <script async defer
                src="https://maps.googleapis.com/maps/api/js?key={{ config('google.maps.api_key') }}&callback=iniciarMapa">
            </script>
            */ ?>
        </section>

        <div class="ancla" id="consulta"></div>
        <section class="consulta contenedor">
            <div class="formulario">
                @if(count($errors)>0)
                    <div class="errores">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('consultar') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="campos">
                        
                        <div class="col c-100">
                            <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="@lang('textos.consulta.campos.nombre')" required>
                        </div>

                        <div class="col c-50">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="@lang('textos.consulta.campos.email')" required>
                        </div>

                        <div class="col c-50">
                            <input type="text" name="telefono" value="{{ old('telefono') }}" placeholder="@lang('textos.consulta.campos.telefono')">
                        </div>

                        <div class="col c-100">
                            <textarea name="mensaje" placeholder="@lang('textos.consulta.campos.mensaje')" required>{{ old('mensaje') }}</textarea>
                        </div>

                    </div>
                
                    <div class="recaptcha">
                        <div class="g-recaptcha" data-sitekey="{{ config('google.recaptcha.sitekey') }}"></div>
                    </div>
                
                    <div class="accion">
                        <button type="submit">@lang('textos.consulta.boton')</button>
                    </div>
                </form>
            </div>
        </section>

        <?php $iconos = App\Models\Icono::front()->get(); ?>
        @if($iconos->count())
            <div class="ancla" id="marcas"></div>
            <section class="iconos contenedor">
                <h2>@lang('textos.iconos.titulo')</h2>
                <ul>
                    @foreach($iconos as $icono)
                        <li>
                            <img src="{{ $icono->url('imagen') }}" title="{{ $icono->nombre }}">
                            @if(!empty($icono->link))
                                <a href="{{ $icono->link }}" target="_blank"></a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif
    </div>
    
    <footer>
        <div class="destacado">
            <div class="contenedor">
                <p>
                    @lang('textos.pie.destacado')
                </p>
            </div>
        </div>
        <div class="info">
            <div class="contenedor">
                <div class="col">
                    <a class="logo" href="{{ url('/') }}">{{ config('app.name') }}</a>
                </div>
                <div class="col">
                    <p>
                        Av. Pedro Goyena 1054, C1424<br>
                        Cdad. Autónoma de Buenos Aires
                        <br>
                        <br>
                        <a href="mailto:info@concienciaastral.com.ar">info@concienciaastral.com.ar</a><br>
                        <a href="https://api.whatsapp.com/send?phone=5491130667262" target="_blank">Whatsapp +5491130667262</a><br>
                    </p>
                </div>
                <div class="col">
                    <div>
                        <div class="redes">
                            <a href="#" target="_blank" class="facebook"></a>
                            <a href="#" target="_blank" class="twitter"></a>
                            <a href="#" target="_blank" class="instagram"></a>
                        </div>
                        <div class="newsletter">
                            <h3>@lang('textos.pie.newsletter.titulo')</h3>
                            @lang('textos.pie.newsletter.texto')
                            <form data-formulario="{{ url('ajax/newsletter') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="exito_titulo" value="@lang('textos.pie.newsletter.exito.titulo')">
                                <input type="hidden" name="exito_texto" value="@lang('textos.pie.newsletter.exito.texto')">
                                <input type="hidden" name="error_titulo" value="@lang('textos.pie.newsletter.error.titulo')">
                                <input type="hidden" name="error_texto" value="@lang('textos.pie.newsletter.error.texto')">
                                <input type="email" name="email" placeholder="@lang('textos.pie.newsletter.campo')" required>
                                <button type="submit"></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <a href="https://api.whatsapp.com/send?phone=5491130667262" target="_blank" class="whatsapp"></a>
</body>
</html>