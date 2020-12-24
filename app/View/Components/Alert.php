<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $type;
    public $dismissible;
    public $text;

    /**
     * Create a new component instance.
     *
     * @param string $text
     * @param string $type
     * @param bool $dismissible
     */
    public function __construct($text = '', $type = 'primary', $dismissible = false)
    {
        $this->text = $text;
        $this->type = $type;
        $this->dismissible = $dismissible;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
