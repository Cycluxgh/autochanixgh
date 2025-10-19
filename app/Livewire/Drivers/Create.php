<?php

namespace App\Livewire\Drivers;

use App\Livewire\Forms\DvlaForm;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Insurance;
use Livewire\Component;

class Create extends Component
{
    public $customers;
    public $companies;
    public $customersDisable = false;
    public $companiesDisable = false;
    public $size = 4;
    public $vehicleNumbers = [];
    public DvlaForm $form;

    public function mount()
    {
        $this->customers = Customer::orderBy('name')->get();
        $this->companies = Company::orderBy('name')->get();
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
        $this->companiesDisable = true;
        $this->size = 6;
    }

    public function handleCompanyChange($value)
    {
        $companyVehicleNumbers = Insurance::where('company_id', $value)->pluck('vehicle_number')
            ->toArray();

        $this->vehicleNumbers = $companyVehicleNumbers;
        $this->customersDisable = true;
        $this->size = 6;
    }

    public function render()
    {
        return view('livewire.drivers.create');
    }
}
