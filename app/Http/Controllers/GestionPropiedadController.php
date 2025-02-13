<?php

namespace App\Http\Controllers;

use App\Facade\Properties\ProcessManagerPropertyFacade;
use App\Models\Institution;
use App\Models\Property;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use RealRashid\SweetAlert\Facades\Alert;

class GestionPropiedadController extends Controller
{
    private string $ruta;
    private int $idUsuario;

    //inyeccion de nuestro facade principal para la mayoria de los procesos...
    private $_processManagerPropertyFacade;

    //validadores.
    public $validador = [
        'numeroHabitaciones' => 'required',
        'numeroBanios' => 'required',
        'numeroEstacionamiento' => 'required',
        'AreaProyecto' => 'required',
        'AltoProyecto' => 'required',
        'PrecioProyecto' => 'required',
        'DescripcionProyecto' => 'required',
        'VideosProyecto' => 'required',
        'ubicacionMapa' => 'required',
        'IM_canton' => 'required|min:1',
        'ParroquiaProyecto' => 'required|min:1',
        'DireccionProyecto' => 'required'
    ];

    public function __construct(
        ProcessManagerPropertyFacade $processManagerPropertyFacade
    ) {
        $this->ruta = config("app.url_api");
        $this->idUsuario = JWTAuth::parseToken()->getPayload()->get('id');

        //este de aqui nos servira de "FACHADA" para la parte de los procesos internos de
        //la gestion de las propiedades.
        $this->_processManagerPropertyFacade = $processManagerPropertyFacade;
    }

    public function propiedad(Request $request) : View
    {
        try {
            $usuariosActivos = User::count();
            $propiedadesDisponibles = Property::count();
            $institucionesDisponibles = Institution::count();

            $this->ruta = config("app.url_api") . "/api/propiedades/listar";

            $respuesta = Http::get($this->ruta);

            $propiedades = array();

            if ($respuesta->successful()) {
                $propiedades = $respuesta->json();
            }

            //el token tendremos que pasarlo a otras partes de nuestra aplicacion
            //por ejepmplo algunas componentes internos que realizaran por su cuenta una
            //peticion a un api y es necesario pasar la parte del token de autenticacion.
            $obteniendoToken = JWTAuth::parseToken()->getToken()->get();

            //informacion de la persona que se autentico.
            $rolUsuario = JWTAuth::parseToken()->getPayload()->get('roles');
            //permisos que tiene el usuario.. en base a ello mostraremos lo que puede y no puede hacer.
            $permisos = JWTAuth::parseToken()->getPayload()->get('permisos');

            return view('moduloGestionPropiedad.propiedad', [
                'propiedades' => $propiedades,
                'rolUsuario' => $rolUsuario,
                'usuariosActivos' => $usuariosActivos,
                'propiedadesDisponibles' => $propiedadesDisponibles,
                'institucionesDisponibles' => $institucionesDisponibles,
                'rolUsuario' => $rolUsuario,
                'permisos' => $permisos,
                'token' => $obteniendoToken
            ]);

        } catch (\Throwable $th) {
            dd("Error ..." . $th->getMessage());
        }
    }


    //actualizacion de nuestra propiedad.
    public function actualizarPropiedad(Request $request)
    {
        
        if ( $request->tipoProyecto == 3 )
        {
            unset($this->validador["numeroEstacionamiento"]);   
            unset($this->validador["numeroBanios"]);   
            unset($this->validador["numeroHabitaciones"]);   
            unset($this->validador["AltoProyecto"]);
            $this->validador["ProfundidadProyecto"] = "required";
        }
        else if ( $request->tipoProyecto == 2 )
        {
            unset($this->validador["numeroEstacionamiento"]);
        }

        $resultado = Validator::make($request->all(),($this->validador));

        if ( $resultado->fails() )
        {
            Alert::error('Editar Propiedad', 'Datos incorrectos o incompletos.')
            ->autoclose(5000);
            return redirect('/propiedades');
        }

        $datos = $request->all();
       
        $respuesta = $this->_processManagerPropertyFacade->procesoEditar($datos);

        if ( $respuesta == "EDITADO PROPIEDAD" )
        {
            Alert::success('Editado Propiedad', 'Propiedad editado correctamente')
            ->autoclose(5000);
            return redirect('/propiedades');
        }

        Alert::error('Editado Propiedad', $respuesta)
        ->autoclose(5000);
        return redirect('/propiedades');
    }

    /**
     * Este metodo de aqui lo vamos a relacionar con nuestro formulario de registro de propiedad.
     */
    public function registrarPropiedad(Request $request)
    {
        if ( $request->tipoProyecto == 3 )
        {
            unset($this->validador["numeroEstacionamiento"]);   
            unset($this->validador["numeroBanios"]);   
            unset($this->validador["numeroHabitaciones"]);   
            unset($this->validador["AltoProyecto"]);
            $this->validador["ProfundidadProyecto"] = "required";
        }
        else if ( $request->tipoProyecto == 2 )
        {
            unset($this->validador["numeroEstacionamiento"]);
        }

        $resultado = Validator::make($request->all(),($this->validador));

        if ( $resultado->fails() )
        {
            Alert::error('Registro Propiedad', 'Datos incorrectos o incompletos.')
            ->autoclose(5000);
            return redirect('/propiedades');
        }

        $datos = $request->all();

        $resultado = $this->_processManagerPropertyFacade->procesoRegistrar($datos);

        if ( $resultado == "REGISTRADO PROPIEDAD" )
        {
            Alert::success('Registro Propiedad', 'Propiedad registrada correctamente')
            ->autoclose(5000);
            return redirect('/propiedades');
        }

        Alert::error('Registro Propiedad', $resultado)
        ->autoclose(5000);
        return redirect('/propiedades');
    }


    public function eliminarPropiedad($id, Request $request)
    {
        $respuesta = $this->_processManagerPropertyFacade->procesoEliminar($id);

        if ( $respuesta == "PROPIEDAD ELIMINADA" )
        {
            Alert::success('Eliminar Propiedad', 'Propiedad eliminada exitosamente')->autoclose(5000);
            return redirect('/propiedades');
        }

        Alert::error('Registro Propiedad', $respuesta)
        ->autoclose(5000);
        return redirect('/propiedades');
    }
}

