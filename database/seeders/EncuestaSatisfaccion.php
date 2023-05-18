<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Encuesta;
use App\Models\Pregunta;
use App\Models\Opcion;

class EncuestaSatisfaccion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $encuesta = Encuesta::make([
            'nombre' => 'Encuesta de satisfacción',
        ]);

        $encuesta->visible = true;
        $encuesta->save();

        for($i=0;$i<7;$i++) {

            $pregunta = Pregunta::make([
                'pregunta' => '¿Cuál de estas opciones te parece la correcta?',
            ]);
            $pregunta->ordenar([['id_encuesta', $encuesta->id]]);
            $encuesta->preguntas()->save($pregunta);

            foreach(['Mala', 'Regular', 'Buena', 'Excelente'] as $valor) {
                $opcion = Opcion::make([
                    'valor' => $valor,
                ]);
                $opcion->ordenar([['id_pregunta', $pregunta->id]]);
                $pregunta->opciones()->save($opcion);
            }
        
        }

    }
}
