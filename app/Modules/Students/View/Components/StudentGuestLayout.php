<?php

namespace App\Modules\Students\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class StudentGuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('student.layouts.guest');
    }
}
