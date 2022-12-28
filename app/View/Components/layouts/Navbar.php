<?php

namespace App\View\Components\layouts;

use Illuminate\View\Component;

class Navbar extends Component
{
    public $brand;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($brand)
    {
        $this->brand = $brand;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.navbar');
    }
}
