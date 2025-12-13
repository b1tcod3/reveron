<?php

namespace B1tcod3\Reveron\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * El tipo de alerta (info, success, warning, error)
     *
     * @var string
     */
    public $type;

    /**
     * El mensaje a mostrar
     *
     * @var string
     */
    public $message;

    /**
     * Título personalizado (opcional)
     *
     * @var string|null
     */
    public $title;

    /**
     * Determina si se debe mostrar un icono
     *
     * @var bool
     */
    public $showIcon;

    /**
     * Determina si la alerta es descartable
     *
     * @var bool
     */
    public $dismissible;

    /**
     * Tipo de animación (fade, slide, bounce)
     *
     * @var string
     */

    public $animated;

    public $animationType;

    /**
     * Determina si la alerta se cierra automáticamente
     *
     * @var bool
     */
    public $autoclose;

    /**
     * Tiempo de cierre automático en milisegundos
     *
     * @var int
     */
    public $autocloseTime;

    /**
     * Nombre del ícono personalizado
     *
     * @var string|null
     */
    public $icon;

    /**
     * Create a new component instance.
     *
     * @param string $type
     * @param string|null $message
     * @param string|null $title
     * @param bool $showIcon
     * @param bool $dismissible
     * @param bool $animated
     * @param string $animationType
     * @param bool $autoclose
     * @param int $autocloseTime
     * @param string|null $icon
     * @return void
     */
    public function __construct(
        string $type = 'info',
        ?string $message = null,
        ?string $title = null,
        bool $showIcon = true,
        bool $dismissible = false,
        bool $animated = false,
        string $animationType = 'fade',
        bool $autoclose = false,
        int $autocloseTime = 5000,
        ?string $icon = null
    ) {
        $this->type = $type;
        $this->message = $message;
        $this->title = $title;
        $this->showIcon = $showIcon;
        $this->dismissible = $dismissible;
        $this->animated = $animated;
        $this->animationType = $animationType;
        $this->autoclose = $autoclose;
        $this->autocloseTime = $autocloseTime;
        $this->icon = $icon;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */

    public function render()
    {
        return view('reveron::components.alert');
    }
}
