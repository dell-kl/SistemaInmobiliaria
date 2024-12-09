<?php

namespace App\Http\Controllers\ApiRestControllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImagenesController extends Controller{

    public function __construct(){}

    public function cargarImagen(Request $request): JsonResponse
    {
        $imagenes = $request->files->get("FileIMG");

        if ( isset($imagenes)) {
            if(!empty($imagenes))
            {
                //generar validacion de mi arreglo de imagenes.
                Validator::validate($imagenes, [
                    "FileIMG.*" => [
                        "required",
                        File::type(['jpg', 'jpeg', 'png'])
                            ->min('1kb')
                            ->max('3mb')
                            ->dimensions(Rule::dimensions()->maxWidth(1920)->maxHeight(1080))
                    ]
                ]);

                return response()->json(['mensaje' => 'Imagen cargada con exito'], 200);
            }
        }

        return response()->json(['mensaje' => 'Parametro indefinido o vacio'], 500);
    }
}

?>
