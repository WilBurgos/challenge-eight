<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatastroRequest;
use App\Models\Catastro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CatastroController extends Controller
{

    public function added_price(CatastroRequest $request, $zip_code, $type){

        $ct = $this->construction_type($request->construction_type);

        switch ($type) {
            case 'max':
                $query = "max( global.price_unit ) AS price_unit,
                        max( global.price_unit_construction ) AS price_unit_construction,
                        count( global.codigo_postal ) AS elements";
                break;
            case 'min':
                $query = "min( global.price_unit ) AS price_unit,
                        min( global.price_unit_construction ) AS price_unit_construction,
                        count( global.codigo_postal ) AS elements";
                break;
            case 'avg':
                $query = "round( avg(global.price_unit) ) AS price_unit,
                        round( avg(global.price_unit_construction) ) AS price_unit_construction,
                        count( global.codigo_postal ) AS elements";
                break;

            default:
            $query = "round( avg(global.price_unit) ) AS price_unit,
                    round( avg(global.price_unit_construction) ) AS price_unit_construction,
                    count( global.codigo_postal ) AS elements";
                break;
        }

        $price = DB::select("SELECT
                    '$type' AS type,
                    ".$query."
                    FROM (
                        SELECT
                            codigo_postal,
                            round( (valor_suelo/superficie_terreno) - subsidio ) AS price_unit,
                            round( (valor_suelo/superficie_construccion) - subsidio ) AS price_unit_construction
                        FROM catastro
                        WHERE (codigo_postal = '$zip_code' AND uso_construccion = '$ct')
                        GROUP BY codigo_postal, price_unit, price_unit_construction
                    )
                    AS global"
        );

        $array = [
            "type"                      => $price[0]->type,
            "price_unit"                => $price[0]->price_unit,
            "price_unit_construction"   => $price[0]->price_unit_construction,
            "elements"                  => $price[0]->elements
        ];

        return response()->json([
            "status"    => true,
            "payload"   => $array
        ],200);
    }

    public function construction_type($type){
        $value = null;
        switch ($type) {
            case '1':
                $value = 'Áreas verdes';
                break;
            case '2':
                $value = 'Centro de barrio';
                break;
            case '3':
                $value = 'Equipamiento';
                break;
            case '4':
                $value = 'Habitacional';
                break;
            case '5':
                $value = 'Habitacional y comercial';
                break;
            case '6':
                $value = 'Industrial';
                break;
            case '7':
                $value = 'Sin Zonificación';
                break;
            default:
                $value = null;
                break;
        }

        return $value;
    }
}
