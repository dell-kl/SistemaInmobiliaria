<?php

namespace App\Providers;

use App\Facade\ContentVisual\CoordinatesFacades;
use App\Facade\ContentVisual\ImagesFacades;
use App\Facade\ContentVisual\MediaFacades;
use App\Facade\ContentVisual\PlansFacades;
use App\Facade\Properties\ProcessManagerPropertyFacade;
use App\Facade\Properties\ProcessPropertyFacade;
use App\Http\Controllers\ApiRestControllers\PropiedadesController;
use App\Services\CoordenadasServices;
use App\Services\ImagenesServices;
use App\Services\PlansServices;
use App\Services\PropiedadesServices;
use App\Services\VideosServices;
use Illuminate\Support\ServiceProvider;
use Namshi\JOSE\JWT;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /**
         * ==============================================================
         *              SECCION DE LA PARTE DE PROPIEDADES
         * ==============================================================
         */

        $this->app->singleton(PropiedadesServices::class, function($app){
            $url = config('app.url_api') . '/api/propiedades/';
            $token = JWTAuth::getToken()->get();
            return new PropiedadesServices($token, $url);
        });

        $this->app->singleton(ProcessPropertyFacade::class, function($app){
            return new ProcessPropertyFacade($app->make(PropiedadesServices::class));
        });

        $this->app->singleton(ProcessManagerPropertyFacade::class, function($app){

            return new ProcessManagerPropertyFacade(
                $app->make(ProcessPropertyFacade::class),
                $app->make(ImagesFacades::class),
                $app->make(PlansFacades::class),
                $app->make(MediaFacades::class),
                $app->make(CoordinatesFacades::class)
            );


        });


        /**
         * ==============================================================
         *             SECCION DE LA PARTE DE IMAGENES
         * ==============================================================
         */

        $this->app->singleton(ImagenesServices::class, function($app){
            $url = config('app.url_api') . '/api/imagenes/';
            $token = JWTAuth::getToken()->get();
            return new ImagenesServices($token, $url);
        });

        $this->app->singleton(ImagesFacades::class, function($app){
            return new ImagesFacades($app->make(ImagenesServices::class));
        });

        /**
         * ==============================================================
         *             SECCION DE LA PARTE DE PLANOS
         * ==============================================================
         */

        $this->app->singleton(PlansServices::class, function($app){
            $url = config('app.url_api') . '/api/planos/';
            $token = JWTAuth::getToken()->get();
            return new PlansServices($token, $url);
        });

        $this->app->singleton(PlansFacades::class, function($app){
            return new PlansFacades($app->make(PlansServices::class));
        });


        /**
         * ==============================================================
         *             SECCION DE LA PARTE DE VIDEOS
         * ==============================================================
         */

        $this->app->singleton(VideosServices::class, function($app){
            $url = config('app.url_api') . '/api/videos/';
            $token = JWTAuth::getToken()->get();
            return new VideosServices($token, $url);
        });

        $this->app->singleton(MediaFacades::class, function($app){
            return new MediaFacades($app->make(VideosServices::class));
        });


        /**
         * ==============================================================
         *            SECCION DE LA PARTE DE COORDENADAS
         * ==============================================================
         */

        $this->app->singleton(CoordenadasServices::class, function($app){
            $url = config('app.url_api') . '/api/coordenadas/';
            $token = JWTAuth::getToken()->get();
            return new CoordenadasServices($token, $url);
        });

        $this->app->singleton(CoordinatesFacades::class, function($app){
            return new CoordinatesFacades($app->make(CoordenadasServices::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
