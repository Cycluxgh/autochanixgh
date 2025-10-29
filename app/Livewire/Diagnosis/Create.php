<?php

namespace App\Livewire\Diagnosis;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Diagnosis;
use App\Models\Insurance;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    public $customerId;
    public $companyId;
    #[Validate('required|string')]
    public $vehicleNumber;
    #[Validate('required|string')]
    public $diagnosis;

    public $customers;
    public $companies;
    public $vehicleNumbers = [];

    public $showCustomersList = true;
    public $showCompaniesList = true;

    public function mount()
    {
        $this->customers = Customer::orderBy('name')->get();
        $this->companies = Company::orderBy('name')->get();
    }

    public function save()
    {
        $this->validate();

        Diagnosis::create([
            'customer_id' => $this->customerId['value'] ?? null,
            'company_id' => $this->companyId['value'] ?? null,
            'vehicle_number' => $this->vehicleNumber,
            'diagnosis' => $this->diagnosis,
        ]);

        session()->flash('success', 'Vehicle ' . $this->vehicleNumber . ' diagnosis created successfully.');
        $this->reset();

        $this->redirectRoute('diagnosis.create');
    }

    public function handleCustomersOptions($customerId)
    {
        $this->showCompaniesList = false;
        $this->vehicleNumbers = Insurance::where('customer_id', $customerId)
            ->pluck('vehicle_number')
            ->toArray();
    }

    public function handleCompaniesOptions($companyId)
    {
        $this->showCustomersList = false;
        $this->vehicleNumbers = Insurance::where('company_id', $companyId)
            ->pluck('vehicle_number')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.diagnosis.create');
    }
}
