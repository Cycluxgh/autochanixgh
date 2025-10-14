<?php

namespace App\Livewire\Diagnosis;

use App\Models\Diagnosis;
use App\Util;
use Livewire\Component;

class Edit extends Component
{
    use Util;

    public $diagnosis;
    public $_diagnosis;

    public function mount(string $diagnosisId)
    {
        $this->_diagnosis = Diagnosis::firstWhere('id', $this->decrypt($diagnosisId));
        $this->diagnosis = $this->_diagnosis->diagnosis;
    }

    public function update()
    {
        $this->_diagnosis->update([
            'diagnosis' => $this->diagnosis,
        ]);

        session()->flash('message', 'Diagnosis updated successfully.');
    }

    public function render()
    {
        return view('livewire.diagnosis.edit');
    }
}
