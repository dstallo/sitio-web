<?php

use App\Models\Texto;

$texto = Texto::cargar();

return [
    'datos' => [
        'email' => $texto->obtener('datos.email', 'en'),
        'telefono' => $texto->obtener('datos.telefono', 'en'),
        'direccion' => $texto->obtener('datos.direccion', 'en'),
        'whatsapp' => $texto->obtener('datos.whatsapp', 'en'),
        'ubicacion' => $texto->obtener('datos.ubicacion', 'en'),
    ],
	'servicios' => [
        'menu' => $texto->obtener('servicios.menu', 'en'),
        'titulo' => $texto->obtener('servicios.titulo', 'en'),
		'texto' => $texto->obtener('servicios.texto', 'en'),
	],
	'novedades' => [
		'menu' => $texto->obtener('novedades.menu', 'en'),
        'titulo' => $texto->obtener('novedades.titulo', 'en'),
        'texto'  => $texto->obtener('novedades.texto', 'en'),
	],
    'publicaciones' => [
        'menu'  => $texto->obtener('publicaciones.menu', 'en'),
		'titulo'  => $texto->obtener('publicaciones.titulo', 'en'),
        'texto'  => $texto->obtener('publicaciones.texto', 'en'),
	],
	'lugar' => [
        'menu' => $texto->obtener('lugar.menu', 'en'),
		'titulo' => $texto->obtener('lugar.titulo', 'en'),
		'texto' => $texto->obtener('lugar.texto', 'en'),
	],
	'ubicacion' => [
		'menu' => $texto->obtener('ubicacion.menu', 'en'),
		'titulo' => $texto->obtener('ubicacion.titulo', 'en'),
		'texto' => $texto->obtener('ubicacion.texto', 'en'),
	],
    'sucursales' => [
        'menu'  => $texto->obtener('sucursales.menu', 'en'),
		'titulo'  => $texto->obtener('sucursales.titulo', 'en'),
        'texto'  => $texto->obtener('sucursales.texto', 'en'),
    ],
    'contacto' => [
        'menu'  => $texto->obtener('contacto.menu', 'en'),
		'titulo'  => $texto->obtener('contacto.titulo', 'en'),
        'texto'  => $texto->obtener('contacto.texto', 'en'),
    ],
    'socios' => [
        'menu'  => $texto->obtener('socios.menu', 'en'),
		'titulo'  => $texto->obtener('socios.titulo', 'en'),
		'texto' => $texto->obtener('socios.texto', 'en'),
	],
    'agenda' => [
        'menu'  => $texto->obtener('agenda.menu', 'en'),
		'titulo'  => $texto->obtener('agenda.titulo', 'en'),
		'texto' => $texto->obtener('agenda.texto', 'en'),
	],
	'consulta' => [
		'campos' => [
			'nombre' => 'Name',
			'email' => 'Email',
			'telefono' => 'Phone',
			'mensaje' => 'Message',
		],
		'boton' => 'Send',
		'errores' => [
			'captcha' => "You didn't check the captcha",
		],
		'exito' => [
			'titulo' => 'Message sent',
			'texto' => '<p>Thank you for contacting us.</p><p>We will contact you soon.</p>',
		],
	],
	'pie' => [
		'texto' => $texto->obtener('pie.texto', 'en'),
        'contacto' => $texto->obtener('pie.contacto', 'en'),
		'newsletter' => [
			'titulo' => $texto->obtener('pie.newsletter.titulo', 'en'),
			'texto' => $texto->obtener('pie.newsletter.texto', 'en'),
			'campo' => 'your email',
			'exito' => [
				'titulo' => 'Subscription successfull',
				'texto' => 'Your e-mail address was successfully registered on our newsletter.',
			],
			'error' => [
				'titulo' => 'Error',
				'texto' => 'An error has occurred. Please try again later.',
			],
		],
	],
	'encuesta' => [
		'titulo' => $texto->obtener('encuesta.titulo', 'en'),
		'texto' => $texto->obtener('encuesta.texto', 'en'),
		'boton' => $texto->obtener('encuesta.boton', 'en'),
		'exito' => [
			'titulo' => $texto->obtener('encuesta.exito.titulo', 'en'),
			'texto' => $texto->obtener('encuesta.exito.texto', 'en'),
		]
	],
];
