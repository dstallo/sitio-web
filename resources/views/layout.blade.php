<?php
$tiene_servicios = App\Models\Servicio::front()->count();
$tiene_novedades = App\Models\Novedad::front()->count();
$tiene_contenidos = App\Models\Contenido::front()->count();
$tiene_publicaciones = App\Models\Publicacion::front()->count();
$tiene_agenda = App\Models\Evento::front()->count();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ url('favicon.png') }}" type="image/png"  />
    <link rel="icon" href="{{ url('favicon.ico') }}" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{ url('apple-touch-icon.png') }}" />

    <meta name="description" content="@yield('descripcion', config('app.description'))" />
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <meta property="og:locale" content="es_AR" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="@yield('imagen', url('favicon.png'))" />
    <meta property="og:title" content="@yield('titulo', config('app.name'))" />
    <meta property="og:description" content="@yield('bajada', config('app.description'))" />
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
    @include('flasher.flasher')
    
    <header>
        <div class="contenedor barra">
            <ul class="info">
                <li><span class="icono marcador"></span>@lang('textos.datos.direccion')</li>
                <li><span class="icono telefono"></span>@lang('textos.datos.telefono')</li>
                <li><span class="icono email"></span><a href="mailto:@lang('textos.datos.email')">@lang('textos.datos.email')</a></li>
            </ul>
            <ul class="apps">
                <li><a href="https://xhendra.ar/" target="_blank"><span>Xendra</span></a></li>
                <li><a href="https://webmail.froebel.edu.ar/" target="_blank"><span class="icono email"></span><span>WebMail</span></a></li>
            </ul>
        </div>
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
                @php $menues = []; @endphp
                @foreach($paginas as $pagina)
                    @if ($pagina->menu)
                        @if (in_array($pagina->menu, $menues))
                            @continue;
                        @endif
                        @php
                            $menues[] = $pagina->menu;
                        @endphp
                        <li>
                            <a href="#" class="dropdown-action">{{ $pagina->menu }}</a>
                            <div class="dropdown">
                            @foreach($paginas->where('menu', $pagina->menu)->sortBy('orden') as $submenu)
                                <a href="{{ $submenu->href() }}" class="dropdown-item">{{ $submenu->titulo }}</a>
                            @endforeach
                            </div>
                        </li>
                    @else
                        <li><a href="{{ $pagina->href() }}">{{ $pagina->titulo }}</a></li>
                    @endif
                @endforeach
            
                @if ($tiene_servicios && lang('textos.servicios.menu'))
                    <li><a href="/#servicios">@lang('textos.servicios.menu')</a></li>
                @endif
                @if (App\Models\Sucursal::front()->count()>0 && lang('textos.sucursales.menu'))
                    <li><a href="{{ route('sucursales') }}">@lang('textos.sucursales.menu')</a></li>
                @endif
                @if ($tiene_novedades && lang('textos.novedades.menu'))
                    <li><a href="{{ route('novedades') }}">@lang('textos.novedades.menu')</a></li>
                @endif
                @if ($tiene_contenidos && lang('textos.lugar.menu'))
                    <li><a href="/#nuestro-lugar">@lang('textos.lugar.menu')</a></li>
                @endif
                @if (lang('textos.ubicacion.menu'))
                    <li><a href="/#ubicacion">@lang('textos.ubicacion.menu')</a></li>
                @endif
                @if ($tiene_publicaciones && lang('textos.publicaciones.menu'))
                    <li><a href="{{ route('publicaciones') }}">@lang('textos.publicaciones.menu')</a></li>
                @endif
                @if ($tiene_agenda && lang('textos.agenda.menu'))
                    <li><a href="/#agenda">@lang('textos.agenda.menu')</a></li>
                @endif
                @if (App\Models\Icono::front()->count()>0 && lang('textos.socios.menu'))
                    <li><a href="/#socios">@lang('textos.socios.menu')</a></li>
                @endif
                @if (lang('textos.contacto.menu'))
                    <li><a href="/#consulta">@lang('textos.contacto.menu')</a></li>
                @endif
                </ul>
            </nav>
            
            <ul class="redes">
                <li><a class="idioma instagram" target="_blank" href="#"></a></li>
                <li><a class="idioma email" href="mailto:@lang('textos.datos.email')"></a></li>
            </ul>
            
            
        </div>
    </header>

    <div class="landing">
        @yield('contenido')

        <div class="ancla" id="ubicacion"></div>
        <section class="ubicacion contenedor">
        @if (lang('textos.ubicacion.titulo'))
            <h2>@lang('textos.ubicacion.titulo')</h2>
        @endif
        @if (lang('textos.ubicacion.texto'))
            <div class="intro">
                @lang('textos.ubicacion.texto')
            </div>
        @endif
        </section>
        <div class="ubicacion contenedor-mapa">
            <div class="mapa" id="mapa"></div>
            
            <script type="text/javascript">
                var mapa, marcador, info, bounds;


                var marcadores = [
                    {"lat": -34.4516942586787, "lng": -58.53769388127857, "popup": '<p style="font-size:16px; margin-bottom:5px;"><b>Dirección:</b> Alfredo Palacios 1063, B1644BRK Victoria, Provincia de Buenos Aires</p><p style="font-size:16px; margin-bottom:5px;"><b>Whatsapp:</b> 11 5315 7340</p><p style="font-size:16px;"><b>E-Mail:</b> <a href="mailto:@lang('textos.datos.email')">@lang('textos.datos.email')</a></p>'},
                ];

                function iniciarMapa() {

                    mapa = new google.maps.Map(document.getElementById('mapa'), {zoom: 15, center: {lat: -34.4516942586787, lng: -58.53769388127857 }});

                    bounds = new google.maps.LatLngBounds();
                    

                    marcadores.forEach(function(item){

                        let position = {lat: item.lat, lng: item.lng};

                        item.marker = new google.maps.Marker({
                            position: position, 
                            map: mapa
                        });

                        item.infoWindow = new google.maps.InfoWindow({
                            content: item.popup
                        });

                        item.marker.addListener('click', function() {
                            item.infoWindow.open(mapa, item.marker);
                        });

                        bounds.extend(position);
                    })

                    //mapa.fitBounds(bounds);
                    
                }
            </script>
            <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('google.maps.api_key') }}&libraries=maps,marker&callback=iniciarMapa"></script>
        </div>
        <div class="ancla" id="consulta"></div>
        <section class="consulta contenedor">
        @if (lang('textos.contacto.titulo'))
            <h2>@lang('textos.contacto.titulo')</h2>
        @endif
        @if (lang('textos.contacto.texto'))
            <div class="intro">
                @lang('textos.contacto.texto')
            </div>
        @endif
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

        <?php $socios = App\Models\Icono::front()->get(); ?>
        @if($socios->count())
            <div class="ancla" id="socios"></div>
            <section class="iconos contenedor">
            @if (lang('textos.socios.titulo'))
                <h2>@lang('textos.socios.titulo')</h2>
            @endif
            @if (lang('textos.socios.texto'))
                <div class="intro">
                    @lang('textos.socios.texto')
                </div>
            @endif
                <ul>
                    @foreach($socios as $socio)
                        <li>
                            <img src="{{ $socio->url('imagen') }}" title="{{ $socio->nombre }}">
                            @if(!empty($socio->link))
                                <a href="{{ $socio->link }}" target="_blank"></a>
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
                @lang('textos.pie.texto')
            </div>
        </div>
        <div class="info">
            <div class="contenedor">
                <div class="col">
                    <a class="logo" href="{{ url('/') }}">{{ config('app.name') }}</a>
                </div>
                <div class="col datos">
                    @lang('textos.pie.contacto')
                </div>
                <div class="col">
                    <div>
                    
                        <div class="redes">
                            <a href="#" target="_blank" class="facebook"></a>
                            <a href="mailto:@lang('textos.datos.email')" target="_blank" class="email"></a>
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
    <a href="https://api.whatsapp.com/send?phone={{ preg_replace('/[^0-9]/', '', __('textos.datos.whatsapp')) }}" target="_blank" class="whatsapp"></a>
</body>
</html>