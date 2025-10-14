<?php

namespace App\Livewire\Drivers;

use App\Livewire\Forms\DvlaForm;
use App\Models\Customer;
use Livewire\Component;

class Create extends Component
{
    public $customers;
    public DvlaForm $form;

    public function mount()
    {
        $this->customers = Customer::orderBy('name')->get();
    }

    public function save()
    {
        $this->form->store();
        session()->flash('success', 'Dvla information saved successfully.');
    }

    public function render()
    {
        return view('livewire.drivers.create');
    }
}
