<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ url('icono.png') }}" />

    <meta name="description" content="Casa Ganesha - Colonia del Sacramento - Uruguay" />
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <meta property="og:locale" content="es_AR" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="@yield('imagen', url('logo.png'))" />
    <meta property="og:title" content="@yield('titulo', config('app.name'))" />
    <meta property="og:description" content="@yield('bajada', 'Casa Ganesha - Colonia del Sacramento - Uruguay.')" />
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
                    <h1>Casa Ganesha</h1>
                @else
                    <h2>Casa Ganesha</h2>
                @endif
            </a>
            <nav>
                <a class="desplegar-menu-principal"><span></span></a>
                <ul>
                    <li><a href="/#servicios">Ganesha</a></li>
                    <li><a href="/#novedades">Novedades</a></li>
                    <li><a href="/#galeria">Galería</a></li>
                    <li><a href="/#ubicacion">Dónde estamos</a></li>
                    <li><a href="" target="_blank">Reservar</a></li>
                    <li><a href="/#consulta">Contacto</a></li>
                </ul>
            </nav>
            
            <a class="airbnb" href="" target="_blank"></a>
            
            <div class="redes">
                <a class="email" href="mailto:casaganesha@abulafiagroup.com"></a>
                <a class="compartir addthis_button_more"></a>
            </div>
        </div>
    </header>

    <div class="landing">
        @yield('contenido')

        <div class="ancla" id="ubicacion"></div>
        <section class="ubicacion contenedor">
            <h2>Dónde estamos</h2>
            <div class="intro">
                <p>
                    A sólo 10 kilometros del Casco histórico, puerto ó terminal de buses y luego de atravesar un precioso camino rural aledaño al Río de la Plata, llegarás a Casa Ganesha Colonia.
                </p>
            </div>
            <div class="mapa" id="mapa">
                <a href="https://goo.gl/maps/GFoLBKja82q5Be1N7" target="_blank">
                    <img src="{{ url('img/mapa.jpg') }}" alt="Mapa">
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
                            <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre" required>
                        </div>

                        <div class="col c-50">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                        </div>

                        <div class="col c-50">
                            <input type="text" name="telefono" value="{{ old('telefono') }}" placeholder="Teléfono">
                        </div>

                        <div class="col c-100">
                            <textarea name="mensaje" placeholder="Mensaje" required>{{ old('mensaje') }}</textarea>
                        </div>

                    </div>

                    <div class="recaptcha">
                        <div class="g-recaptcha" data-sitekey="{{ config('google.recaptcha.sitekey') }}"></div>
                    </div>

                    <div class="accion">
                        <button type="submit">Enviar</button>
                    </div>
                </form>
            </div>
        </section>

        <?php $iconos = App\Models\Icono::front()->get(); ?>
        @if($iconos->count())
            <div class="ancla" id="marcas"></div>
            <section class="iconos contenedor">
                <h2>¡Gracias por acompañarnos!</h2>
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
                    ¡Te esperamos para disfrutar Casa Ganesha!
                </p>
            </div>
        </div>
        <div class="info">
            <div class="contenedor">
                <div class="col">
                    <a class="logo" href="{{ url('/') }}">Gasa Ganesha</a>
                </div>
                <div class="col">
                    <p>
                        Tula Suarez de Cutinella, 70000<br>
                        Colonia del Sacramento,<br>
                        Departamento de Colonia, Uruguay<br>
                        <br>
                        
                        <a href="mailto:casaganesha@abulafiagroup.com">casaganesha@abulafiagroup.com</a><br>
                        <a href="https://api.whatsapp.com/send?phone=5491132527673" target="_blank">Whatsapp +5491132527673</a><br>
                    </p>
                </div>
                <div class="col">
                    <div>
                        <div class="redes">
                            <a href="https://facebook.com" target="_blank" class="facebook"></a>
                            <a href="https://twitter.com" target="_blank" class="twitter"></a>
                            <a href="https://instagram.com" target="_blank" class="instagram"></a>
                            <a href="#" class="compartir addthis_button_more"></a>
                        </div>
                        <div class="newsletter">
                            <h3>Newsletter</h3>
                            <p>¡Suscribite y recibí novedades y promociones!</p>
                            <form data-formulario="{{ url('ajax/newsletter') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="exito_titulo" value="Inscripción realizada">
                                <input type="hidden" name="exito_texto" value="Tu e-mail fue inscripto a nuestro newsletter con éxito.">
                                <input type="hidden" name="error_titulo" value="Error">
                                <input type="hidden" name="error_texto" value="Ocurrió un error al enviar tu inscripción. Por favor intentá de nuevo más tarde.">
                                <input type="email" name="email" placeholder="tu email acá" required>
                                <button type="submit"></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <a href="https://api.whatsapp.com/send?phone=5491132527673" target="_blank" class="whatsapp"></a>
</body>
</html>