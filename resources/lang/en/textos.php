<?php

use App\Models\Texto;

$texto = Texto::cargar();

return [
    'datos' => [
        'email' => $texto->obtener('datos.email', 'en'),
        'telefono' => $texto->obtener('datos.telefono', 'en'),
        'direccion' => $texto->obtener('datos.direccion', 'en'),
    ],
	'menu' => [
		'servicios' => 'Servicios',
		'novedades' => 'News',
		'lugar' => 'Our Place',
		'ubicacion' => 'Location',
		'inscripcion' => 'Subscribe',
		'contacto' => 'Contact us',
        'socios' => 'Partners',
        'sucursales' => 'Sucursales',
        'publicaciones' => 'Publicaciones',
        'agenda'    => 'Agenda'
	],
	'servicios' => [
		'texto' => $texto->obtener('servicios.texto', 'en'),
	],
	'novedades' => [
		'titulo' => 'News',
        'texto'  => $texto->obtener('novedades.texto', 'en'),
	],
    'publicaciones' => [
		'titulo' => 'Publicaciones',
        'texto'  => $texto->obtener('publicaciones.texto', 'en'),
	],
	'lugar' => [
		'titulo' => 'Our place',
		'texto' => $texto->obtener('lugar.texto', 'en'),
	],
	'ubicacion' => [
		'titulo' => 'Location',
		'texto' => $texto->obtener('ubicacion.texto', 'en'),
	],
    'sucursales' => [
        'titulo' => 'Sucursales',
        'texto' => $texto->obtener('sucursales.texto', 'en'),
    ],
    'socios' => [
        'titulo' => 'Partners',
		'texto' => $texto->obtener('socios.texto', 'en'),
	],
    'agenda' => [
        'titulo' => 'Agenda',
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
			'titulo' => 'Newsletter',
			'texto' => '<p>Subscribe and get our latest news and promotions!</p>',
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
		'titulo' => 'Customer experience survey',
		'intro' => '<p>We invite you to complete our survey.<br>Your answers will help us get better.</p>',
		'boton' => 'SEND',
		'exito' => [
			'titulo' => 'Your answers have been sent',
			'texto' => '<p>Thank you.</p>',
		]
	],
];
