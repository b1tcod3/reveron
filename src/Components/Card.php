<?php

namespace B1tcod3\Reveron\Components;

use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Título de la tarjeta
     *
     * @var string|null
     */
    public $title;

    /**
     * Subtítulo de la tarjeta
     *
     * @var string|null
     */
    public $subtitle;

    /**
     * URL de la imagen de la tarjeta
     *
     * @var string|null
     */
    public $image;

    /**
     * Texto alternativo para la imagen
     *
     * @var string|null
     */
    public $imageAlt;

    /**
     * Estilo de la tarjeta (default, outlined, elevated, flat)
     *
     * @var string
     */
    public $variant;

    /**
     * Tamaño de la tarjeta (sm, md, lg)
     *
     * @var string
     */
    public $size;

    /**
     * Determina si la tarjeta debe tener animación
     *
     * @var bool
     */
    public $animated;

    /**
     * Tipo de animación (fade, slide, scale)
     *
     * @var string
     */
    public $animationType;

    /**
     * Determina si la imagen debe ocupar todo el ancho
     *
     * @var bool
     */
    public $fullWidthImage;

    /**
     * Determina si se debe mostrar el pie de tarjeta
     *
     * @var bool
     */
    public $showFooter;

    /**
     * Create a new component instance.
     *
     * @param string|null $title
     * @param string|null $subtitle
     * @param string|null $image
     * @param string|null $imageAlt
     * @param string $variant
     * @param string $size
     * @param bool $animated
     * @param string $animationType
     * @param bool $fullWidthImage
     * @param bool $showFooter
     * @return void
     */
    public function __construct(
        ?string $title = null,
        ?string $subtitle = null,
        ?string $image = null,
        ?string $imageAlt = null,
        string $variant = 'default',
        string $size = 'md',
        bool $animated = false,
        string $animationType = 'fade',
        bool $fullWidthImage = false,
        bool $showFooter = false
    ) {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->image = $image;
        $this->imageAlt = $imageAlt;
        $this->variant = $variant;
        $this->size = $size;
        $this->animated = $animated;
        $this->animationType = $animationType;
        $this->fullWidthImage = $fullWidthImage;
        $this->showFooter = $showFooter;
    }


    public function render()
    {
        return view('reveron::components.card');
    }
}