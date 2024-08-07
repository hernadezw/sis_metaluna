<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AppLayout extends Component
{
    use LivewireAlert;
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
