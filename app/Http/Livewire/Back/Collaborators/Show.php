<?php

namespace App\Http\Livewire\Back\Collaborators;

use Livewire\Component;

class Show extends Component
{
    public $collaborator;
    public function render()
    {
        return view('livewire.back.collaborators.show');
    }
}
