<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonPrimary extends Component
{
    public $href;

    public $class;
    /**
     * Create a new component instance.
     */
    public function __construct($href = null, $class = '')
    {
        $this->href = $href;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button-primary');
    }
}
