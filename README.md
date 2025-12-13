# Reveron UI Kit

Un paquete de componentes de interfaz de usuario para Laravel Blade.

## Instalación

Para instalar el paquete, agrega el siguiente repositorio a tu `composer.json`:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/b1tcod3/reveron"
    }
]
```

Luego, instala el paquete a través de composer:

```bash
composer require b1tcod3/reveron
```

El Service Provider se registrará automáticamente.

Si deseas personalizar las vistas de los componentes, puedes publicarlas con:

```bash
php artisan vendor:publish --provider="B1tcod3\Reveron\ReveronProvider" --tag="reveron-views"
```

## Uso

Este paquete proporciona varios componentes Blade que puedes usar en tus vistas.

### Alerta (Alert)

Para mostrar un componente de alerta:

```blade
<x-reveron::alert type="success" message="Este es un mensaje de éxito." />
<x-reveron::alert type="error" message="Este es un mensaje de error." />
<x-reveron::alert type="info" message="Este es un mensaje informativo." />
```

**Props disponibles:**

*   `type`: (Opcional) El tipo de alerta. Puede ser `success`, `error`, o `info` (por defecto).
*   `message`: (Requerido) El mensaje a mostrar en la alerta.

### Tarjeta (Card)

Para mostrar un componente de tarjeta:

```blade
<x-reveron::card title="Mi Tarjeta" subtitle="Un subtítulo opcional">
    Este es el contenido de la tarjeta.
</x-reveron::card>
```

**Props disponibles:**

*   `title`: (Opcional) El título de la tarjeta.
*   `subtitle`: (Opcional) El subtítulo de la tarjeta.
*   `image`: (Opcional) URL de la imagen de la tarjeta.
*   `imageAlt`: (Opcional) Texto alternativo para la imagen.
*   `variant`: (Opcional) Estilo de la tarjeta. Puede ser `default`, `outlined`, `elevated`, o `flat` (por defecto `default`).
*   `size`: (Opcional) Tamaño de la tarjeta. Puede ser `sm`, `md`, o `lg` (por defecto `md`).
*   `animated`: (Opcional) Si la tarjeta debe tener animación (por defecto `false`).
*   `animationType`: (Opcional) Tipo de animación. Puede ser `fade`, `slide`, o `scale` (por defecto `fade`).
*   `fullWidthImage`: (Opcional) Si la imagen debe ocupar todo el ancho (por defecto `false`).
*   `showFooter`: (Opcional) Si se debe mostrar el pie de tarjeta (por defecto `false`).

Para el pie de tarjeta, usa el slot `footer`:

```blade
<x-reveron::card title="Mi Tarjeta" showFooter="true">
    Contenido principal.
    <x-slot name="footer">
        Pie de la tarjeta.
    </x-slot>
</x-reveron::card>
```

## Contenido del Repositorio

*   `packages/B1tcod3/Reveron`: Contiene el código fuente del paquete de Laravel.
    *   `composer.json`: Define las dependencias y metadatos del paquete.
    *   `src/Components/`: Las clases de los componentes (Alert.php, Card.php).
    *   `src/ReveronProvider.php`: El Service Provider del paquete.
    *   `resources/views/components/`: Las plantillas de Blade para los componentes (alert.blade.php, card.blade.php).
