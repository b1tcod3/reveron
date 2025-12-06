<?php

namespace DevMaster\UiKit\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $type;
    public $message;

    public function __construct($type = 'info', $message = '')
    {
        $this->type = $type;
        $this->message = $message;
    }

    public function render()
    {
        // Observa 'reveron::' antes del path. Refiere al namespace definido en el Provider.
        return view('reveron::components.alert');
    }
    
    // Método helper opcional para clases CSS
    public function classForType()
    {
        return match($this->type) {
            'success' => 'bg-green-100 text-green-800 border-green-200',
            'error' => 'bg-red-100 text-red-800 border-red-200',
            default => 'bg-blue-100 text-blue-800 border-blue-200',
        };
    }
}
