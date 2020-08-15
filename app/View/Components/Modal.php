<?php

namespace App\View\Components;

use App\Mesa;
use Illuminate\View\Component;

class Modal extends Component
{
    public $name;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $title)
    {
        $this->name = $name;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.modal');
    }

    public function findMesa(int $id) {
        return Mesa::find($id);
    }
}
