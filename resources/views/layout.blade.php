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
    <link rel="shortcut icon" href="{{ url('favicon.svg') }}" type="image/svg+xml"  />
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
                @foreach($paginas as $pagina)
                    <li><a href="{{ $pagina->link ? $pagina->link : $pagina->href() }}">{{ $pagina->titulo }}</a></li>
                @endforeach
                @if ($tiene_servicios)
                    <li><a href="/#servicios">@lang('textos.menu.servicios')</a></li>
                @endif
                @if (App\Models\Sucursal::front()->count()>0)
                    <li><a href="{{ route('sucursales') }}">@lang('textos.menu.sucursales')</a></li>
                @endif
                @if ($tiene_novedades)
                    <li><a href="/#novedades">@lang('textos.menu.novedades')</a></li>
                @endif
                @if ($tiene_contenidos)
                    <li><a href="/#nuestro-lugar">@lang('textos.menu.lugar')</a></li>
                @endif
                    <li><a href="/#ubicacion">@lang('textos.menu.ubicacion')</a></li>
                @if (App\Models\Icono::front()->count()>0)
                    <li><a href="/#coberturas">@lang('textos.menu.coberturas')</a></li>
                @endif
                    <li><a href="/#consulta">@lang('textos.menu.contacto')</a></li>
                </ul>
            </nav>
            
            
                <ul class="redes">
                    <li><a class="idioma email" href="mailto:info@daxsalud.com.ar"></a></li>
                </ul>
            
            
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
        </section>
        <div class="ubicacion contenedor-mapa">
            <div class="mapa" id="mapa"></div>
            
            <script type="text/javascript">
                var mapa, marcador, info, bounds;


                var marcadores = [
                    {"lat": -34.582874, "lng": -58.4101125, "popup": '<h1 style="font-size:20px; margin-bottom:10px;">Buenos Aires</h1><p style="font-size:16px; margin-bottom:5px;">Las Heras 3341, Piso 11</p><p style="font-size:16px; margin-bottom:5px;">Tel.: 11 2881 0425</p><p style="font-size:16px;"><a href="mailto:info@daxsalud.com.ar">info@daxsalud.com.ar</a></p>'},
                    {"lat": -31.740675, "lng": -60.5216869, "popup": '<h1 style="font-size:20px; margin-bottom:10px;">Entre Ríos</h1><p style="font-size:16px; margin-bottom:5px;">Pascual Echague 1065, Paraná</p><p style="font-size:16px;"><a href="mailto:info.er@daxsalud.com.ar">info.er@daxsalud.com.ar</a></p>'},
                    {"lat": -26.825056, "lng": -65.2028709, "popup": '<h1 style="font-size:20px; margin-bottom:10px;">Tucumán</h1><p style="font-size:16px; margin-bottom:5px;">Torre Vittalia: Santiago del Estero 157, Piso 2</p><p style="font-size:16px; margin-bottom:5px;">Tel.: 11 2881 0425</p><p style="font-size:16px;"><a href="mailto:info.tuc@daxsalud.com.ar">info.tuc@daxsalud.com.ar</a></p>'}
                ];


                function iniciarMapa() {

                    mapa = new google.maps.Map(document.getElementById('mapa'), {zoom: 10, center: {lat: -30.987320358631, lng: -62.485087265736446 }});

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

                    mapa.fitBounds(bounds);
                    
                }
            </script>
            <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('google.maps.api_key') }}&libraries=maps,marker&callback=iniciarMapa"></script>
        </div>
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
            <div class="ancla" id="coberturas"></div>
            <section class="iconos contenedor">
                <h2>@lang('textos.iconos.titulo')</h2>
                <div class="intro">
                    @lang('textos.iconos.texto')
                </div>
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
                            <a href="mailto:info@daxsalud.com.ar" target="_blank" class="email"></a>
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
    <a href="https://api.whatsapp.com/send?phone=1128810425" target="_blank" class="whatsapp"></a>
</body>
</html>