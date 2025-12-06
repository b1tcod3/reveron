<?php

namespace B1tcod3\Reveron;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class UiKitServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 1. Cargar las vistas (el HTML de los componentes)
        // El primer argumento es la ruta, el segundo es el "namespace" de las vistas
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'reveron');

        // 2. Registrar el namespace de los Componentes de Clase (Backend)
        // Esto permite usar <x-uikit::alert /> y que busque la clase Alert en src/Components
        Blade::componentNamespace('B1tcode\\Reveron\\Components', 'uikit');
        
        // Opcional: Publicar vistas si quieres que el usuario las pueda editar
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/reveron'),
        ], 'uikit-views');
    }

    public function register()
    {
        // Aquí registrarías configs si tuvieras
    }
}
