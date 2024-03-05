<?php

namespace App\Http\Livewire\Back\Risk;

use App\Models\Measure;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Show extends Component
{
    public $risk;
    public function render()
    {
        return view('livewire.back.risk.show');
    }
}
