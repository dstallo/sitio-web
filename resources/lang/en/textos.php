<?php

use App\Models\Texto;

$texto = Texto::cargar();

return [
	'menu' => [
		'servicios' => 'Services',
        'sucursales' => 'Centros',
		'novedades' => 'News',
		'lugar' => 'Our Place',
		'ubicacion' => 'Location',
		'inscripcion' => 'Subscribe',
		'contacto' => 'Contact us',
        'coberturas' => 'Coverage'
	],
	'servicios' => [
		'texto' => $texto->obtener('servicios.texto', 'en'),
	],
	'novedades' => [
		'titulo' => 'News',
        'texto'  => $texto->obtener('novedades.texto', 'en'),
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
        'titulo' => 'Centros de Atención',
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
	'iconos' => [
        'titulo' => "Coverage y Associates",
		'texto' => $texto->obtener('coberturas.texto', 'en'),
	],
	'pie' => [
		'texto' => $texto->obtener('pie.texto', 'en'),
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
