<?php

namespace App\Livewire\Drivers;

use App\Livewire\Forms\DvlaForm;
use App\Models\Customer;
use App\Models\Insurance;
use Livewire\Component;

class Create extends Component
{
    public $customers;
    public $vehicleNumbers = [];
    public DvlaForm $form;

    public function mount()
    {
        $this->customers = Customer::orderBy('name')->get();
    }

    public function save()
    {
        $this->form->store();
        session()->flash('success', 'Dvla information saved successfully.');

        $this->redirectRoute('drivers.create');
    }

    public function handleCustomerChange($value)
    {
        $customerVehicleNumbers = Insurance::where('customer_id', $value)->pluck('vehicle_number')
            ->toArray();

        $this->vehicleNumbers = $customerVehicleNumbers;
    }

    public function render()
    {
        return view('livewire.drivers.create');
    }
}
