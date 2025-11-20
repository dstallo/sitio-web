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
            'id' => 'servicios.texto',
            'texto_es' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
            'texto_en' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>'
        ]);

        DB::table('textos')->insert([
            'id' => 'novedades.texto',
            'texto_es' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
            'texto_en' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>'
        ]);

        DB::table('textos')->insert([
            'id' => 'publicaciones.texto',
            'texto_es' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
            'texto_en' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>'
        ]);

        DB::table('textos')->insert([
            'id' => 'lugar.texto',
            'texto_es' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
            'texto_en' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>'
        ]);

        DB::table('textos')->insert([
            'id' => 'ubicacion.texto',
            'texto_es' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
            'texto_en' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>'
        ]);

        DB::table('textos')->insert([
            'id' => 'sucursales.texto',
            'texto_es' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
            'texto_en' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>'
        ]);

        DB::table('textos')->insert([
            'id' => 'agenda.texto',
            'texto_es' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
            'texto_en' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>'
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
            'texto_en' => 'Lorem ipsum dolor sit amet'
        ]);

        DB::table('textos')->insert([
            'id' => 'datos.telefono',
            'texto_es' => '11 2233 4455',
            'texto_en' => '11 2233 4455'
        ]);

        DB::table('textos')->insert([
            'id' => 'datos.email',
            'texto_es' => 'test@test.com.ar',
            'texto_en' => 'test@test.com.ar'
        ]);
    }
}
