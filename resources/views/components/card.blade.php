@php
    // Lógica para obtener clases CSS según la variante de la tarjeta
    $variants = [
        'default' => 'bg-white dark:bg-gray-800 shadow-md',
        'outlined' => 'bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700',
        'elevated' => 'bg-white dark:bg-gray-800 shadow-lg',
        'flat' => 'bg-gray-50 dark:bg-gray-700',
    ];

    $variantClasses = $variants[$variant] ?? $variants['default'];

    // Lógica para obtener clases CSS según el tamaño de la tarjeta
    $sizes = [
        'sm' => 'p-3',
        'md' => 'p-4',
        'lg' => 'p-6',
    ];

    $sizeClasses = $sizes[$size] ?? $sizes['md'];

    // Lógica para obtener clases CSS para la animación
    $animationClasses = '';
    if ($animated) {
        $animationClassMap = [
            'fade' => 'transition-opacity duration-300 ease-in-out',
            'slide' => 'transition-all duration-300 ease-in-out transform',
            'scale' => 'transition-all duration-300 ease-in-out transform',
        ];

        $animationClasses = $animationClassMap[$animationType] ?? $animationClassMap['fade'];
    }

    // Lógica para obtener clases CSS para la animación inicial
    $initialAnimationClass = '';
    if ($animated) {
        $initialClasses = [
            'fade' => 'opacity-0',
            'slide' => 'opacity-0 translate-y-4',
            'scale' => 'opacity-0 scale-95',
        ];

        $initialAnimationClass = $initialClasses[$animationType] ?? $initialClasses['fade'];
    }

    // Lógica para obtener clases CSS para el contenedor de la imagen
    $imageContainerBaseClasses = 'overflow-hidden';
    if ($fullWidthImage) {
        $imageContainerClasses = $imageContainerBaseClasses . ' -m-4 mb-4';
    } else {
        $imageContainerClasses = $imageContainerBaseClasses . ' rounded-t-lg -m-4 mb-4';
    }

    // Lógica para obtener clases CSS para la imagen
    $imageBaseClasses = 'w-full object-cover';
    $imageClasses = $imageBaseClasses . ' h-48';

    $uniqueId = 'card-' . uniqid();
@endphp

<div
    id="{{ $uniqueId }}"
    {{ $attributes->merge(['class' => 'rounded-lg ' . $variantClasses . ' ' . $sizeClasses . ' ' . $animationClasses . ' ' . $initialAnimationClass]) }}
>
    @if ($image)
        <div class="{{ $imageContainerClasses }}">
            <img
                src="{{ $image }}"
                alt="{{ $imageAlt ?? $title ?? 'Card image' }}"
                class="{{ $imageClasses }} {{ $animated ? 'transition-transform duration-300 hover:scale-105' : '' }}"
            >
        </div>
    @endif

    <div class="flex flex-col h-full">
        @if ($title || $subtitle)
            <div class="mb-3">
                @if ($title)
                    <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
                @endif

                @if ($subtitle)
                    <p class="text-sm text-gray-500 mt-1">{{ $subtitle }}</p>
                @endif
            </div>
        @endif

        <div class="flex-1 text-gray-700">
            {{ $slot }}
        </div>

        @if ($showFooter)
            <div class="mt-4 pt-3 border-t border-gray-100 {{ $animated ? 'transition-colors duration-200' : '' }}">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>

@if ($animated)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cardElement = document.getElementById('{{ $uniqueId }}');
            if (cardElement) {
                // Pequeño retraso para asegurar que el DOM está completamente cargado
                setTimeout(() => {
                    // Eliminar clases iniciales de animación para iniciar la animación
                    cardElement.classList.remove('{{ $initialAnimationClass }}');

                    @if ($animationType == 'slide')
                        cardElement.classList.add('translate-y-0');
                    @elseif ($animationType == 'scale')
                        cardElement.classList.add('scale-100');
                    @else
                        cardElement.classList.add('opacity-100');
                    @endif
                }, 100);
            }
        });
    </script>
@endif