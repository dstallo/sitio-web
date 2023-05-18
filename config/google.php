<?php

return [
	'recaptcha' => [
		'sitekey' => env('RECAPTCHA_SITEKEY'),
		'secret' => env('RECAPTCHA_SECRET'),
	],
	'maps' => [
		'api_key' => env('GMAPS_APIKEY'),
	]
];