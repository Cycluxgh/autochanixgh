<?php

namespace App\Livewire\Renewals;

use App\Livewire\Forms\RenewalForm;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Insurance;
use App\Models\Renewal;
use App\Util;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use Util, WithFileUploads;

    public $customers;
    public $companies;
    public $hideCustomersSelect = false;
    public $hideCompaniesSelect = false;
    public $showAddRenewalForm = false;
    public $showEditRenewalForm = false;
    public $size = 4;
    public $vehicleNumbers = [];
    public $renewals = [];
    public RenewalForm $form;

    public function mount()
    {
        $this->customers = Customer::orderBy('name')->get();
        $this->companies = Company::orderBy('name')->get();
        $this->renewals = Renewal::orderBy('created_at', 'desc')->get();
    }

    public function handleCustomersOption($value)
    {
        $this->vehicleNumbers = Insurance::where('customer_id', $value)->pluck('vehicle_number')
            ->toArray();
        $this->hideCompaniesSelect = true;
        $this->size = 6;
    }

    public function handleCompaniesOption($value)
    {
        $this->vehicleNumbers = Insurance::where('company_id', $value)->pluck('vehicle_number')
            ->toArray();
        $this->hideCustomersSelect = true;
        $this->size = 6;
    }


    public function save()
    {
        try {
            $this->form->store();

            $this->showAddRenewalForm = true;
            $this->reset();
            session()->flash('success', 'Vehicle number renewal saved successfully.');

            $this->redirectRoute('renewals.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function edit($renewalId)
    {
        $this->showAddRenewalForm = false;
        $this->showEditRenewalForm = true;

        $this->form->setRenewal($renewalId);
    }

    public function update()
    {
        try {
            $this->form->update();

            $this->reset();
            session()->flash('success', 'Vehicle number renewal updated successfully.');

            $this->redirectRoute('renewals.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function delete($renewalId)
    {
        $renewal = Renewal::firstWhere('id', $renewalId);
        if ($renewal) {
            $path = $this->extractOriginalFilePath($renewal->document);
            Storage::disk('public')->delete($path);
        }

        $renewal->delete();
        session()->flash('success', 'Renewal information deleted successfully.');
    }

    public function render()
    {
        return view('livewire.renewals.index');
    }
}
