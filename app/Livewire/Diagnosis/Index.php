<?php

namespace App\Livewire\Diagnosis;

use App\Models\Diagnosis;
use App\Util;
use Livewire\Component;

class Index extends Component
{
    use Util;

    public $diagnoses;

    public function mount()
    {
        $this->diagnoses = Diagnosis::orderBy('created_at')->get();
    }

    public function delete($diagnosisId)
    {
        Diagnosis::firstWhere('id', $diagnosisId)->delete();
        session()->flash('success', 'Diagnosis successfully deleted.');
    }

    public function render()
    {
        return view('livewire.diagnosis.index');
    }
}
