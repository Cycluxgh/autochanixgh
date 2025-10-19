<?php

namespace App\Livewire\Renewals;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Insurance;
use App\Util;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use Util, WithFileUploads;

    #[Validate('nullable|exists:customers,id')]
    public $customer_id;
    #[Validate('nullable|exists:companies,id')]
    public $company_id;
    #[Validate('required|exists:insurances,vehicle_number')]
    public $vehicle_number;
    #[Validate('required|file|mimes:jpg,jpeg,png,avif,webp,pdf|max:2048')]
    public $document;

    public $customers;
    public $companies;
    public $hideCustomersSelect = false;
    public $hideCompaniesSelect = false;
    public $showForm = false;
    public $size = 3;
    public $vehicleNumbers = [];

    public function mount()
    {
        $this->customers = Customer::orderBy('name')->get();
        $this->companies = Company::orderBy('name')->get();
    }

    public function handleCustomersOption($value)
    {
        $this->vehicleNumbers = Insurance::where('customer_id', $value)->pluck('vehicle_number')
            ->toArray();
        $this->hideCompaniesSelect = true;
        $this->size = 4;
    }

    public function handleCompaniesOption($value)
    {
        $this->vehicleNumbers = Insurance::where('customer_id', $value)->pluck('vehicle_number')
            ->toArray();
        $this->hideCustomersSelect = true;
        $this->size = 4;
    }

    public function save()
    {
        ds($this->customer_id);
    }

    public function render()
    {
        return view('livewire.renewals.index');
    }
}
