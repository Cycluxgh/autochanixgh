<?php

namespace App\Livewire\Forms;

use App\Models\Insurance;
use App\Models\Renewal;
use App\Util;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class RenewalForm extends Form
{
    use Util, WithFileUploads;

    public $customer_id = ['value' => null];
    public $company_id = ['value' => null];

    #[Validate('required|exists:insurances,vehicle_number')]
    public $vehicle_number;
    public $policy_number;

    #[Validate('nullable', message: 'Please attach an image or PDF for renewal')]
    #[Validate('file', message: 'Please upload a valid file.')]
    #[Validate('mimes:jpg,jpeg,png,avif,webp,pdf', message: 'Only images or PDFs are allowed.')]
    #[Validate('max:2048', message: 'File size must not exceed 2MB.')]
    public $document;

    #[Validate('required|date|date_format:Y-m-d|before_or_equal:today')]
    public $inception;

    #[Validate('required|date|date_format:Y-m-d|after:inception')]
    public $expiration;
    public $path;
    public ?Renewal $renewal;
    public $customer_company;

    public function setRenewal(int $renewalId)
    {
        $this->renewal = Renewal::firstWhere('id', $renewalId);

        if ($this->renewal) {
            $this->customer_company = $this->renewal->customer?->name ?? $this->renewal->company?->name;
            $this->vehicle_number = $this->renewal->vehicle_number;
            $this->policy_number = $this->renewal->policy_number;
            $customerInsurance = $this->renewal->customer?->insurances()
                ->where('vehicle_number', $this->renewal->vehicle_number)->first();
            if ($customerInsurance) {
                $this->inception = $customerInsurance->inception;
                $this->expiration = $customerInsurance->expiration;
            }
            $companyInsurance = $this->renewal->company?->insurances()
                ->where('vehicle_number', $this->renewal->vehicle_number)->first();
            if ($companyInsurance) {
                $this->inception = $companyInsurance->inception;
                $this->expiration = $companyInsurance->expiration;
            }
        }
    }

    public function store()
    {
        $this->validate();

        if ($this->document) {
            $this->path = $this->uploadSingleImage($this->document, 'images/renewals');
        }

        try {
            DB::transaction(function () {
                if ($this->customer_id) {
                    $insurance = Insurance::where('customer_id', (int) $this->customer_id['value'])
                        ->where('vehicle_number', $this->vehicle_number)
                        ->first();
                    if ($insurance) {
                        $insurance->update([
                            'inception' => $this->inception,
                            'expiration' => $this->expiration,
                        ]);
                    }
                } elseif ($this->company_id) {
                    $insurance = Insurance::where('company_id', $this->company_id['value'])
                        ->where('vehicle_number', $this->vehicle_number)
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
                    'policy_number' => $this->policy_number,
                    'document' => $this->path,
                ]);
            });

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                $customer = $this->renewal->customer;
                if ($customer) {
                    $customer->insurances()->where('vehicle_number', $this->renewal->vehicle_number)
                        ->update([
                            'inception' => $this->inception,
                            'expiration' => $this->expiration,
                        ]);
                }

                $company = $this->renewal->company;
                if ($company) {
                    $company->insurances()->where('vehicle_number', $this->renewal->vehicle_number)
                        ->update([
                            'inception' => $this->inception,
                            'expiration' => $this->expiration,
                        ]);
                }

                if ($this->document) {
                    $this->path = $this->uploadSingleImage($this->document, 'images/renewals');
                }

                $this->renewal->update([
                    'document' => $this->path ?: $this->renewal->document,
                    'policy_number' => $this->policy_number,
                ]);
            });

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function rules()
    {
        $renewalId = $this->renewalId ?? $this->renewal?->id ?? null;
        return [
            'policy_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('renewals', 'policy_number')->ignore($renewalId),
            ],
        ];
    }
}
