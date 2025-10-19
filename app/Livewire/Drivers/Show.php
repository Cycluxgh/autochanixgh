<?php

namespace App\Livewire\Drivers;

use App\Models\Diagnosis;
use App\Models\Dvla;
use App\Util;
use Livewire\Component;

class Show extends Component
{
    use Util;

    public ?Dvla $dvla;

    public function mount(string $dvlaId)
    {
        $this->dvla = Dvla::firstWhere('id', $this->decrypt($dvlaId));
    }

    public function render()
    {
        return view('livewire.drivers.show');
    }
}
