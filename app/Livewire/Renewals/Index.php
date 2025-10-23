<?php

namespace App\Livewire\Renewals;

use App\Livewire\Forms\RenewalForm;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Insurance;
use App\Models\Renewal;
use App\Util;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use Util, WithFileUploads;

//    public $customer_id = ['value' => null];
//    public $company_id = ['value' => null];
//
//    #[Validate('required|exists:insurances,vehicle_number')]
//    public $vehicle_number;
//    #[Validate('required|string|unique:renewals,policy_number')]
//    public $policy_number;
//
//    #[Validate('nullable', message: 'Please attach an image or PDF for renewal')]
//    #[Validate('file', message: 'Please upload a valid file.')]
//    #[Validate('mimes:jpg,jpeg,png,avif,webp,pdf', message: 'Only images or PDFs are allowed.')]
//    #[Validate('max:2048', message: 'File size must not exceed 2MB.')]
//    public $document;
//
//    #[Validate('required|date|date_format:Y-m-d|before_or_equal:today')]
//    public $inception;
//
//    #[Validate('required|date|date_format:Y-m-d|after:inception')]
//    public $expiration;

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

    // Edit Properties

//    #[Validate('nullable', message: 'Please attach an image or PDF for renewal')]
//    #[Validate('file', message: 'Please upload a valid file.')]
//    #[Validate('mimes:jpg,jpeg,png,avif,webp,pdf', message: 'Only images or PDFs are allowed.')]
//    #[Validate('max:2048', message: 'File size must not exceed 2MB.')]
    public $edit_document;
//    #[Validate('required|date|date_format:Y-m-d|before_or_equal:today')]
    public $edit_inception;
//    #[Validate('required|date|date_format:Y-m-d|after:inception')]
    public $edit_expiration;
//    #[Validate('required|string|unique:renewals,policy_number')]
    public $edit_policy_number;

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
//        $this->renewal = Renewal::firstWhere('id', $renewalId);
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
