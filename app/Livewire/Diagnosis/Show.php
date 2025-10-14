<?php

namespace App\Livewire\Diagnosis;

use App\Models\Diagnosis;
use App\Util;
use Livewire\Component;

class Show extends Component
{
    use Util;

    public $diagnosis;

    public function mount(string $diagnosisId)
    {
        $this->diagnosis = Diagnosis::firstWhere('id', $this->decrypt($diagnosisId));
    }

    public function render()
    {
        return view('livewire.diagnosis.show');
    }
}
