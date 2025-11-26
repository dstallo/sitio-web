<?php

use App\Models\Texto;

$texto = Texto::cargar();

return [
    'datos' => [
        'email' => $texto->obtener('datos.email', 'es'),
        'telefono' => $texto->obtener('datos.telefono', 'es'),
        'direccion' => $texto->obtener('datos.direccion', 'es'),
        'whatsapp' => $texto->obtener('datos.whatsapp', 'es'),
        'ubicacion' => $texto->obtener('datos.ubicacion', 'es'),
    ],
	'servicios' => [
        'menu'  => $texto->obtener('servicios.menu', 'es'),
        'titulo' => $texto->obtener('servicios.titulo', 'es'),
		'texto' => $texto->obtener('servicios.texto', 'es'),
	],
	'novedades' => [
        'menu'  => $texto->obtener('novedades.menu', 'es'),
		'titulo' => $texto->obtener('novedades.titulo', 'es'),
        'texto' => $texto->obtener('novedades.texto', 'es'),
	],
    'publicaciones' => [
        'menu'  => $texto->obtener('publicaciones.menu', 'es'),
		'titulo'  => $texto->obtener('publicaciones.titulo', 'es'),
        'texto'  => $texto->obtener('publicaciones.texto', 'es'),
	],
	'lugar' => [
        'menu' => $texto->obtener('lugar.menu', 'es'),
		'titulo' => $texto->obtener('lugar.titulo', 'es'),
		'texto' => $texto->obtener('lugar.texto', 'es'),
	],
	'ubicacion' => [
		'menu' => $texto->obtener('ubicacion.menu', 'es'),
		'titulo' => $texto->obtener('ubicacion.titulo', 'es'),
		'texto' => $texto->obtener('ubicacion.texto', 'es'),
	],
    'sucursales' => [
        'menu'  => $texto->obtener('sucursales.menu', 'es'),
		'titulo'  => $texto->obtener('sucursales.titulo', 'es'),
        'texto'  => $texto->obtener('sucursales.texto', 'es'),
    ],
    'contacto' => [
        'menu'  => $texto->obtener('contacto.menu', 'es'),
		'titulo'  => $texto->obtener('contacto.titulo', 'es'),
        'texto'  => $texto->obtener('contacto.texto', 'es'),
    ],
    'socios' => [
        'menu'  => $texto->obtener('socios.menu', 'es'),
		'titulo'  => $texto->obtener('socios.titulo', 'es'),
		'texto' => $texto->obtener('socios.texto', 'es'),
	],
    'agenda' => [
        'menu'  => $texto->obtener('agenda.menu', 'es'),
		'titulo'  => $texto->obtener('agenda.titulo', 'es'),
		'texto' => $texto->obtener('agenda.texto', 'es'),
	],
	'consulta' => [
		'campos' => [
			'nombre' => 'Nombre',
			'email' => 'Email',
			'telefono' => 'Teléfono',
			'mensaje' => 'Mensaje',
		],
		'boton' => 'Enviar',
		'errores' => [
			'captcha' => 'No tildaste la opción "No soy un robot"',
		],
		'exito' => [
			'titulo' => 'Información enviada',
			'texto' => '<p>Gracias por ponerte en contacto con nosotros.</p><p>Muy pronto nos podremos en contacto con vos.</p>',
		],
	],
	'pie' => [
		'texto' => $texto->obtener('pie.texto', 'es'),
        'contacto' => $texto->obtener('pie.contacto', 'es'),
		'newsletter' => [
			'titulo' => 'Newsletter',
			'texto' => '<p>¡Suscribite y recibí novedades y promociones!</p>',
			'campo' => 'tu email acá',
			'exito' => [
				'titulo' => 'Inscripción realizada',
				'texto' => 'Tu e-mail fue inscripto a nuestro newsletter con éxito.',
			],
			'error' => [
				'titulo' => 'Error',
				'texto' => 'Ocurrió un error al enviar tu inscripción. Por favor intentá de nuevo más tarde.',
			],
		],
	],
	'encuesta' => [
		'titulo' => 'Encuesta de satisfacción',
		'intro' => '<p>Te invitamos a completar esta encuesta  de satisfacción.<br>Tu participación nos ayudan a seguir mejorando nuestro servicio.</p>',
		'boton' => 'ENVIAR',
		'exito' => [
			'titulo' => 'Encuesta completa',
			'texto' => '<p>Gracias por darnos tu opinión.</p>',
		]
	],
];
