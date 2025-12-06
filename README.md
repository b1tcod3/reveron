# Reveron UI Kit

Un paquete de componentes de interfaz de usuario para Laravel Blade.

## Instalación

Puedes instalar el paquete a través de composer:

```bash
composer require b1tcod3/reveron
```

El Service Provider se registrará automáticamente.

Si deseas personalizar las vistas de los componentes, puedes publicarlas con:

```bash
php artisan vendor:publish --provider="B1tcod3\Reveron\ReveronProvider" --tag="uikit-views"
```

## Uso

Este paquete proporciona varios componentes Blade que puedes usar en tus vistas.

### Alerta (Alert)

Para mostrar un componente de alerta:

```blade
<x-uikit::alert type="success" message="Este es un mensaje de éxito." />
<x-uikit::alert type="error" message="Este es un mensaje de error." />
<x-uikit::alert type="info" message="Este es un mensaje informativo." />
```

**Props disponibles:**

*   `type`: (Opcional) El tipo de alerta. Puede ser `success`, `error`, o `info` (por defecto).
*   `message`: (Requerido) El mensaje a mostrar en la alerta.

## Contenido del Repositorio

*   `packages/B1tcod3/Reveron`: Contiene el código fuente del paquete de Laravel.
    *   `composer.json`: Define las dependencias y metadatos del paquete.
    *   `src/`: Lógica del backend, incluyendo las clases de los componentes y el Service Provider.
    *   `resources/views/`: Las plantillas de Blade para los componentes.
