<?php

namespace App\Http\Livewire\Back\Activities;

use Livewire\Component;

class Show extends Component
{
    public $activity;
    public function render()
    {
        return view('livewire.back.activities.show');
    }
}
