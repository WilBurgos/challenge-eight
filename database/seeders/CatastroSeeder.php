<?php

namespace Database\Seeders;

use App\Models\Catastro;
use Illuminate\Database\Seeder;

class CatastroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Catastro::truncate();

        $csvFile = fopen(base_path("database/data/sig_cdmx_GUSTAVO_A._MADERO_08-2020.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 258040, ",")) !== FALSE) {
            if (!$firstline) {
                Catastro::create([
                    "fid"                           => $data['0'] != '' ? $data['0'] : null,
                    "geo_shape"                     => $data['1'] != '' ? $data['1'] : null,
                    "call_numero"                   => $data['2'] != '' ? $data['2'] : null,
                    "codigo_postal"                 => ($data['3'] != '' && is_numeric($data['3'])) ? $data['3'] : null,
                    "colonia_predio"                => $data['4'] != '' ? $data['4'] : null,
                    "superficie_terreno"            => $data['5'] != '' ? $data['5'] : null,
                    "superficie_construccion"       => $data['6'] != '' ? $data['6'] : null,
                    "uso_construccion"              => $data['7'] != '' ? $data['7'] : null,
                    "clave_rango_nivel"             => $data['8'] != '' ? $data['8'] : null,
                    "anio_construccion"             => $data['9'] != '' ? $data['9'] : null,
                    "instalaciones_especiales"      => $data['10'] != '' ? $data['10'] : null,
                    "valor_unitario_suelo"          => $data['11'] != '' ? $data['11'] : null,
                    "valor_suelo"                   => ($data['12'] != '' && $data['12'] != '#########.##') ? $data['12'] : null,
                    "clave_valor_unitario_suelo"    => $data['13'] != '' ? $data['13'] : null,
                    "colonia_cumpliemiento"         => $data['14'] != '' ? $data['14'] : null,
                    "alcaldia_cumplimiento"         => $data['15'] != '' ? $data['15'] : null,
                    "subsidio"                      => $data['16'] != '' ? $data['16'] : null,

                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
