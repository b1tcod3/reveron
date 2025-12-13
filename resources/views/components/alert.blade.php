@php
    // Acceder a las propiedades del componente
    $type = $type ?? 'info';
    $title = $title ?? null;
    $message = $message ?? null;
    $animated = $animated ?? true;
    $animationType = $animationType ?? 'fade';
    $showIcon = $showIcon ?? true;
    $dismissible = $dismissible ?? true;
    $autoclose = $autoclose ?? false;
    $autocloseTime = $autocloseTime ?? 5000;
    $icon = $icon ?? null;
@endphp

@php
    // Estructura consolidada de estilos y colores base
    $styles = [
        'info' => [
            'classes' => 'bg-gray-50 dark:bg-gray-900 border-l-4 border-gray-400 dark:border-gray-600 text-gray-700 dark:text-gray-300',
            'icon' => 'information-circle',
            'icon_color' => 'text-gray-500',
            'dismiss_color' => 'text-gray-400 hover:text-gray-500 dark:text-gray-600 dark:hover:text-gray-500',
        ],
        'success' => [
            'classes' => 'bg-green-50 dark:bg-green-900 border-l-4 border-green-400 dark:border-green-600 text-green-700 dark:text-green-300',
            'icon' => 'check-circle',
            'icon_color' => 'text-green-500',
            'dismiss_color' => 'text-green-400 hover:text-green-500 dark:text-green-600 dark:hover:text-green-500',
        ],
        'warning' => [
            'classes' => 'bg-yellow-50 dark:bg-yellow-900 border-l-4 border-yellow-400 dark:border-yellow-600 text-yellow-700 dark:text-yellow-300',
            'icon' => 'exclamation-triangle',
            'icon_color' => 'text-yellow-500',
            'dismiss_color' => 'text-yellow-400 hover:text-yellow-500 dark:text-yellow-600 dark:hover:text-yellow-500',
        ],
        'error' => [
            'classes' => 'bg-red-50 dark:bg-red-900 border-l-4 border-red-400 dark:border-red-600 text-red-700 dark:text-red-300',
            'icon' => 'x-circle',
            'icon_color' => 'text-red-500',
            'dismiss_color' => 'text-red-400 hover:text-red-500 dark:text-red-600 dark:hover:text-red-500',
        ],
    ];

    $typeConfig = $styles[$type] ?? $styles['info'];
    $baseClass = $typeConfig['classes'];
    $iconName = $icon ?? $typeConfig['icon'];
    $iconColor = $typeConfig['icon_color'];
    $dismissColor = $typeConfig['dismiss_color'];

    // Mapa de iconos con sus path d para fallback
    $iconPaths = [
        'information-circle' => 'M10 18a8 8 0 100-16 8 8 0 000 16zm-1-8a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1zm0 3a1 1 0 112 0v1a1 1 0 11-2 0v-1z',
        'check-circle' => 'M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z',
        'exclamation-triangle' => 'M10 18a8 8 0 100-16 8 8 0 000 16zM10 9a1 1 0 100-2 1 1 0 000 2zm0 4a1 1 0 100-2 1 1 0 000 2z',
        'x-circle' => 'M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z',
    ];

    $iconPath = $iconPaths[$iconName] ?? $iconPaths['information-circle'];

    // Lógica de x-transition para Blade
    $transitionClasses = [];
    if ($animated) {
        if ($animationType === 'fade') {
            $transitionClasses = [
                'x-transition:enter' => 'transition ease-out duration-300',
                'x-transition:enter-start' => 'opacity-0',
                'x-transition:enter-end' => 'opacity-100',
                'x-transition:leave' => 'transition ease-in duration-200',
                'x-transition:leave-start' => 'opacity-100',
                'x-transition:leave-end' => 'opacity-0',
            ];
        } elseif ($animationType === 'slide') {
            $transitionClasses = [
                'x-transition:enter' => 'transition ease-out duration-300 transform',
                'x-transition:enter-start' => 'opacity-0 -translate-y-2',
                'x-transition:enter-end' => 'opacity-100 translate-y-0',
                'x-transition:leave' => 'transition ease-in duration-200 transform',
                'x-transition:leave-start' => 'opacity-100 translate-y-0',
                'x-transition:leave-end' => 'opacity-0 -translate-y-2',
            ];
        }
    }

    // Lógica inicial para Alpine.js
    $alpineData = [];
    $alpineInit = '';

    if ($animated || $autoclose || $dismissible) {
        // x-data y x-show se controlan en el envoltorio para la animación
        $alpineData['x-data'] = '{ show: false }';

        if ($animated) {
            // Animación inicial: aparece después de 100ms para aplicar la transición
            $alpineInit .= 'setTimeout(() => show = true, 100);';
        }

        if ($autoclose) {
            // Cierre automático después de autocloseTime
            $alpineInit .= 'setTimeout(() => show = false, ' . (int) $autocloseTime . ');';
        }

        if (!empty($alpineInit)) {
            $alpineData['x-init'] = $alpineInit;
        }
    }
@endphp

<div
    {{-- Combina clases predeterminadas con las clases pasadas y las de tipo --}}
    {{ $attributes->merge([
        'class' => \Illuminate\Support\Arr::toCssClasses(['rounded-lg p-4', $baseClass])
    ]) }}

    {{-- Alpine.js: Manejo de estado --}}
    @if($animated || $autoclose || $dismissible)
        @foreach($alpineData as $key => $value) {{ $key }}="{{ $value }}" @endforeach
        x-show="show"
    @endif

    {{-- Alpine.js: x-transition para la animación --}}
    @foreach($transitionClasses as $key => $value) {{ $key }}="{{ $value }}" @endforeach
>
    <div class="flex items-start">
        
        {{-- Ícono --}}
        @if($showIcon && $iconName)
            <div class="flex-shrink-0 mr-3 mt-0.5 {{ $iconColor }}">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="{{ $iconPath }}" />
                </svg>
            </div>
        @endif

        <div class="flex-1">
            @if($title)
                <h3 class="font-medium text-lg leading-6">{{ $title }}</h3>
            @endif

            {{-- Manejo de mensaje o slot --}}
            @if($message)
                <p class="mt-1 text-sm">{{ $message }}</p>
            @endif

            {{-- El slot se renderiza después del mensaje predefinido --}}
            {{ $slot }}
        </div>

        {{-- Botón de Cierre --}}
        @if($dismissible)
            <div class="flex-shrink-0 ml-4">
                <button type="button" class="{{ $dismissColor }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-current rounded-md p-1" @click="show = false">
                    <span class="sr-only">Cerrar Alerta</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        @endif
    </div>
</div>
