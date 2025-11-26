<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TextosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('textos')->insert([
            'id' => 'servicios.menu',
            'texto_es' => 'Servicios',
            'texto_en' => 'Servicios',
            'raw'       => true,
        ]);

        DB::table('textos')->insert([
            'id' => 'servicios.titulo',
            'texto_es' => '',
            'texto_en' => '',
            'raw'       => true,
        ]);

        DB::table('textos')->insert([
            'id' => 'servicios.texto',
            'texto_es' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
            'texto_en' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>'
        ]);

        DB::table('textos')->insert([
            'id' => 'novedades.menu',
            'texto_es' => 'Novedades',
            'texto_en' => 'Novedades',
            'raw'       => true,
        ]);

        DB::table('textos')->insert([
            'id' => 'novedades.titulo',
            'texto_es' => 'Novedades',
            'texto_en' => 'Novedades',
            'raw'       => true
        ]);

        DB::table('textos')->insert([
            'id' => 'novedades.texto',
            'texto_es' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
            'texto_en' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>'
        ]);

        DB::table('textos')->insert([
            'id' => 'publicaciones.menu',
            'texto_es' => 'Publicaciones',
            'texto_en' => 'Publicaciones',
            'raw'       => true,
        ]);

        DB::table('textos')->insert([
            'id' => 'publicaciones.titulo',
            'texto_es' => 'Publicaciones',
            'texto_en' => 'Publicaciones',
            'raw'       => true
        ]);

        DB::table('textos')->insert([
            'id' => 'publicaciones.texto',
            'texto_es' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
            'texto_en' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>'
        ]);

        DB::table('textos')->insert([
            'id' => 'lugar.menu',
            'texto_es' => 'Nuestro lugar',
            'texto_en' => 'Nuestro lugar',
            'raw'       => true,
        ]);

        DB::table('textos')->insert([
            'id' => 'lugar.titulo',
            'texto_es' => 'Nuestro lugar',
            'texto_en' => 'Nuestro lugar',
            'raw'       => true
        ]);

        DB::table('textos')->insert([
            'id' => 'lugar.texto',
            'texto_es' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
            'texto_en' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>'
        ]);
        
        DB::table('textos')->insert([
            'id' => 'ubicacion.menu',
            'texto_es' => 'Donde estamos',
            'texto_en' => 'Donde estamos',
            'raw' => true
        ]);

        DB::table('textos')->insert([
            'id' => 'ubicacion.titulo',
            'texto_es' => 'Donde estamos',
            'texto_en' => 'Donde estamos',
            'raw' => true
        ]);

        DB::table('textos')->insert([
            'id' => 'ubicacion.texto',
            'texto_es' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
            'texto_en' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>'
        ]);

        DB::table('textos')->insert([
            'id' => 'sucursales.menu',
            'texto_es' => 'Sucursales',
            'texto_en' => 'Sucursales',
            'raw' => true
        ]);

        DB::table('textos')->insert([
            'id' => 'sucursales.titulo',
            'texto_es' => 'Sucursales',
            'texto_en' => 'Sucursales',
            'raw' => true
        ]);

        DB::table('textos')->insert([
            'id' => 'sucursales.texto',
            'texto_es' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
            'texto_en' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>'
        ]);

        DB::table('textos')->insert([
            'id' => 'contacto.menu',
            'texto_es' => 'Contacto',
            'texto_en' => 'Contacto',
            'raw' => true
        ]);

        DB::table('textos')->insert([
            'id' => 'contacto.titulo',
            'texto_es' => '',
            'texto_en' => '',
            'raw' => true
        ]);

        DB::table('textos')->insert([
            'id' => 'contacto.texto',
            'texto_es' => '',
            'texto_en' => ''
        ]);

        DB::table('textos')->insert([
            'id' => 'agenda.menu',
            'texto_es' => 'Agenda',
            'texto_en' => 'Agenda',
            'raw' => true
        ]);

        DB::table('textos')->insert([
            'id' => 'agenda.titulo',
            'texto_es' => 'Agenda',
            'texto_en' => 'Agenda',
            'raw' => true
        ]);

        DB::table('textos')->insert([
            'id' => 'agenda.texto',
            'texto_es' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
            'texto_en' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>'
        ]);

        DB::table('textos')->insert([
            'id' => 'socios.menu',
            'texto_es' => 'Socios',
            'texto_en' => 'Socios',
            'raw' => true
        ]);

        DB::table('textos')->insert([
            'id' => 'socios.titulo',
            'texto_es' => 'Socios',
            'texto_en' => 'Socios',
            'raw' => true
        ]);

        DB::table('textos')->insert([
            'id' => 'socios.texto',
            'texto_es' => '<p>¡Gracias por acompañarnos!</p>',
            'texto_en' => '<p>¡Gracias por acompañarnos!</p>'
        ]);

        DB::table('textos')->insert([
            'id' => 'pie.texto',
            'texto_es' => '<p>Estamos en contacto.</p>',
            'texto_en' => '<p>Contact Us.</p>'
        ]);

        DB::table('textos')->insert([
            'id' => 'pie.contacto',
            'texto_es' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
            'texto_en' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>'
        ]);

        DB::table('textos')->insert([
            'id' => 'datos.direccion',
            'texto_es' => 'Lorem ipsum dolor sit amet',
            'texto_en' => 'Lorem ipsum dolor sit amet',
            'raw'   => true
        ]);

        DB::table('textos')->insert([
            'id' => 'datos.telefono',
            'texto_es' => '11 2233 4455',
            'texto_en' => '11 2233 4455',
            'raw'   => true
        ]);

        DB::table('textos')->insert([
            'id' => 'datos.email',
            'texto_es' => 'test@test.com.ar',
            'texto_en' => 'test@test.com.ar',
            'raw'   => true
        ]);

        DB::table('textos')->insert([
            'id' => 'datos.whatsapp',
            'texto_es' => '1122334455',
            'texto_en' => '1122334455',
            'raw'   => true
        ]);

        DB::table('textos')->insert([
            'id' => 'datos.ubicacion',
            'texto_es' => '{"lat": -34.6156548, "lng": -58.5156993}',
            'texto_en' => '{"lat": -34.6156548, "lng": -58.5156993}',
            'raw'   => true
        ]);
    }
}
