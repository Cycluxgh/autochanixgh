<?php

namespace App\Livewire\Diagnosis;

use App\Models\Customer;
use App\Models\Diagnosis;
use Livewire\Component;

class Create extends Component
{
    public $customerId;
    public $diagnosis;

    public $customers;

    public function mount()
    {
        $this->customers = Customer::orderBy('name')->get();
    }

    public function save()
    {
        Diagnosis::create([
            'customer_id' => $this->customerId['value'],
            'diagnosis' => $this->diagnosis,
        ]);

        $this->reset();
        session()->flash('success', 'Customer vehicle diagnosis created successfully.');

        $this->redirectRoute('diagnosis.create');
    }

    public function render()
    {
        return view('livewire.diagnosis.create');
    }
}
