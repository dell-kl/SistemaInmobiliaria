<?php

namespace Database\Seeders;

use App\Models\Parroquia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParroquiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Datos proporcionados
        $datos = [
            ['Belisario Quevedo'],
            ['Carcelén'],
            ['Centro Histórico'],
            ['Cochapamba'],
            ['Comité del Pueblo'],
            ['Cotocollao'],
            ['Chilibulo'],
            ['Chillogallo'],
            ['Chimbacalle'],
            ['El Condado'],
            ['Guamaní'],
            ['Iñaquito'],
            ['Itchimbía'],
            ['Jipijapa'],
            ['Kennedy'],
            ['La Argelia'],
            ['La Concepción'],
            ['La Ecuatoriana'],
            ['La Ferroviaria'],
            ['La Libertad'],
            ['La Magdalena'],
            ['La Mena'],
            ['Mariscal Sucre'],
            ['Ponceano'],
            ['Puengasí'],
            ['Quitumbe'],
            ['Rumipamba'],
            ['San Bartolo'],
            ['San Isidro del Inca'],
            ['San Juan'],
            ['Solanda'],
            ['Turubamba'],
            ['Quito Distrito Metropolitano'],
            ['Alangasí'],
            ['Amaguaña'],
            ['Atahualpa'],
            ['Calacalí'],
            ['Calderón'],
            ['Conocoto'],
            ['Cumbayá'],
            ['Chavezpamba'],
            ['Checa'],
            ['El Quinche'],
            ['Gualea'],
            ['Guangopolo'],
            ['Guayllabamba'],
            ['La Merced'],
            ['Llano Chico'],
            ['Lloa'],
            ['Mindo'],
            ['Nanegal'],
            ['Nanegalito'],
            ['Nayón'],
            ['Nono'],
            ['Pacto'],
            ['Pedro Vicente Maldonado'],
            ['Perucho'],
            ['Pifo'],
            ['Píntag'],
            ['Pomasqui'],
            ['Puéllaro'],
            ['Puembo'],
            ['San Antonio'],
            ['San José de Minas'],
            ['San Miguel de Los Bancos'],
            ['Tababela'],
            ['Tumbaco'],
            ['Yaruquí'],
            ['Zambiza'],
            ['Puerto Quito'],
        ];

        // Insertar datos en la base de datos
        foreach ($datos as $dato) {
            $parroquia = new Parroquia();
            $parroquia->parroquias_name = $dato[0]; // Asigna el nombre de la parroquia
            $parroquia->parroquias_state = 1; // Estado por defecto
            $parroquia->Parroquias_cantonsId = 1;
            $parroquia->save(); // Guarda el modelo en la base de datos
        }

    }
}
