<?php

use App\Models\Texto;

$texto = Texto::cargar();

return [
    'datos' => [
        'email' => $texto->obtener('datos.email', 'es'),
        'telefono' => $texto->obtener('datos.telefono', 'es'),
        'direccion' => $texto->obtener('datos.direccion', 'es'),
    ],
	'menu' => [
		'servicios' => 'Servicios',
		'novedades' => 'Novedades',
		'lugar' => 'Nuestro Lugar',
		'ubicacion' => 'Dónde estamos',
		'inscripcion' => 'Inscripción',
		'contacto' => 'Contacto',
        'socios' => 'Socios',
        'sucursales' => 'Sucursales'
	],
	'servicios' => [
		'texto' => $texto->obtener('servicios.texto', 'es'),
	],
	'novedades' => [
		'titulo' => 'Novedades',
        'texto' => $texto->obtener('novedades.texto', 'es'),
	],
    'sucursales' => [
        'titulo' => 'Sucursales',
    ],
	'lugar' => [
		'titulo' => 'Nuestro lugar',
		'texto' => $texto->obtener('lugar.texto', 'es'),
	],
	'ubicacion' => [
		'titulo' => 'Dónde estamos',
		'texto' => $texto->obtener('ubicacion.texto', 'es'),
	],
    'sucursales' => [
        'titulo' => 'Sucursales',
        'texto' => $texto->obtener('sucursales.texto', 'en'),
    ],
    'socios' => [
        'titulo' => 'Socios',
		'texto' => $texto->obtener('socios.texto', 'en'),
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
