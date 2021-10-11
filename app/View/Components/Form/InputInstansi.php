<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class InputInstansi extends Component
{
    public $field, $label;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($field, $label)
    {
        $this->field = $field;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.input-instansi');
    }
}
