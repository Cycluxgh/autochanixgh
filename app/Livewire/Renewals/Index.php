<?php

namespace App\Livewire\Renewals;

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

    #[Validate('nullable|exists:customers,id')]
    public $customer_id;

    #[Validate('nullable|exists:companies,id')]
    public $company_id;

    #[Validate('required|exists:insurances,vehicle_number')]
    public $vehicle_number;

    #[Validate('required', message: 'Please attach an image or PDF for renewal')]
    #[Validate('file', message: 'Please upload a valid file.')]
    #[Validate('mimes:jpg,jpeg,png,avif,webp,pdf', message: 'Only images or PDFs are allowed.')]
    #[Validate('max:2048', message: 'File size must not exceed 2MB.')]
    public $document;

    #[Validate('required|date|date_format:Y-m-d|before_or_equal:today')]
    public $inception;

    #[Validate('required|date|date_format:Y-m-d|after:inception')]
    public $expiration;

    public $customers;
    public $companies;
    public $hideCustomersSelect = false;
    public $hideCompaniesSelect = false;
    public $showAddRenewalForm = false;
    public $size = 4;
    public $path;
    public $vehicleNumbers = [];
    public $renewals = [];

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
        $this->vehicleNumbers = Insurance::where('customer_id', $value)->pluck('vehicle_number')
            ->toArray();
        $this->hideCustomersSelect = true;
        $this->size = 6;
    }

    public function save()
    {
        $this->validate();

        if ($this->document) {
            $this->path = $this->uploadSingleImage($this->document, 'images/renewals');
        }

        try {
            DB::transaction(function () {
                if ($this->customer_id) {
                    $insurance = Insurance::where('customer_id', $this->customer_id['value'])
                        ->where('vehicle_number', $this->vehicleNumbers)
                        ->first();
                    if ($insurance) {
                        $insurance->update([
                            'inception' => $this->inception,
                            'expiration' => $this->expiration,
                        ]);
                    }
                } elseif ($this->company_id) {
                    $insurance = Insurance::where('company_id', $this->company_id['value'])
                        ->where('vehicle_number', $this->vehicleNumbers)
                        ->first();
                    if ($insurance) {
                        $insurance->update([
                            'inception' => $this->inception,
                            'expiration' => $this->expiration,
                        ]);
                    }
                }

                Renewal::create([
                    'customer_id' => $this->customer_id ? $this->customer_id['value'] : null,
                    'company_id' => $this->company_id ? $this->company_id['value'] : null,
                    'vehicle_number' => $this->vehicle_number,
                    'document' => $this->path,
                ]);
            });

            $this->showAddRenewalForm = true;
            $this->reset();
            session()->flash('success', 'Vehicle number renewal saved successfully.');

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
