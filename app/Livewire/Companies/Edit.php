<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use App\Models\Insurance;
use App\Util;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use Util, WithFileUploads;

    public $name;
    public $email;
    public $phone;
    public $ceo;
    #[Validate('nullable|image|mimes:jpeg,png,jpg,gif,svg,avif,webp,ico|max:2048', message: 'Only image files are allowed')]
    public $logo;
    public $address;
    public $path;

    public ?Company $company;
    public $insurances = [
        ['vehicle_number' => '', 'inception' => '', 'expiration' => '']
    ];

    protected $messages = [
        'name' => 'Name is required',
        'email' => 'Email should be unique',
        'phone' => 'Phone is required and should be unique',
        'insurances.*.vehicle_number.required' => 'Vehicle number is required.',
        'insurances.*.inception.required' => 'Inception date is required.',
        'insurances.*.expiration.required' => 'Expiration date is required.',
        'insurances.*.expiration.after' => 'Expiration must be after the inception date.',
    ];

    public function mount(string $companyId)
    {
        $this->company = Company::firstWhere('id', $this->decrypt($companyId));
        $this->name = $this->company?->name;
        $this->email = $this->company?->email;
        $this->phone = $this->company?->phone;
        $this->ceo = $this->company?->ceo;
        $this->address = $this->company?->address;

        $this->insurances = $this->company?->insurances->map(function ($insurance) {
            return [
                'id' => $insurance->id,
                'vehicle_number' => $insurance->vehicle_number,
                'inception' => $insurance->inception,
                'expiration' => $insurance->expiration,
            ];
        })->toArray();
    }

    public function addInsurance()
    {
        $this->insurances[] = [
            'id' => null,
            'vehicle_number' => '',
            'inception' => '',
            'expiration' => '',
        ];
    }

    public function removeInsurance($index)
    {
        unset($this->insurances[$index]);
        $this->insurances = array_values($this->insurances);
    }

    public function update()
    {
//        $this->validate();

        if ($this->logo) {
            $this->path = $this->uploadSingleImage($this->logo, 'images/companies/logos');
        }

        try {

            DB::transaction(function () {
                $this->company->update([
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'ceo' => $this->ceo,
                    'logo' => $this->path ?: $this->company->logo,
                    'address' => $this->address,
                ]);

                $upsertData = collect($this->insurances)->map(function ($insurance) {
                    return array_merge($insurance, [
                        'company_id' => $this->company->id,
                    ]);
                })->toArray();

                $uniqueColumns = ['id'];
                $updateColumns = ['vehicle_number', 'inception', 'expiration'];

                Insurance::upsert($upsertData, $uniqueColumns, $updateColumns);
            });

            session()->flash('success', 'Company information updated successfully with vehicle insurances.');

        } catch (\Exception $exception) {
            session()->flash('error', "Something went wrong: {$exception->getMessage()}");
        }
    }

    protected function rules()
    {
        $companyId = $this->ignore->companyId ?? $this->company->id ?? null;

        return [
            'name' => 'required|string|max:1000',
            'email' => ['nullable', 'email', Rule::unique('companies', 'email')->ignore($companyId)],
            'phone' => ['required', 'max:10', Rule::unique('companies', 'phone')->ignore($companyId)],
            'ceo' => 'nullable|string|max:1000',
            'address' => 'nullable|string|max:2000',
            'insurances.*.vehicle_number' => ['required', 'string', Rule::unique('insurances', 'vehicle_number')->ignore($companyId)],
            'insurances.*.inception' => 'required|date|before_or_equal:today',
            'insurances.*.expiration' => 'required|date|after:insurances.*.inception',
        ];
    }

    public function render()
    {
        return view('livewire.companies.edit');
    }
}
