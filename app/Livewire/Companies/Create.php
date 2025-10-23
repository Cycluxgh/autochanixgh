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

class Create extends Component
{
    use Util, WithFileUploads;

    public $name;
    public $email;
    public $phone;
    public $ceo;
    #[Validate('nullable|image|max:2048|mimes:jpeg,png,jpg,gif,svg,avif,webp')]
    public $logo;
    public $address;
    public $path;

    public $insurances = [
        ['vehicle_number' => '', 'inception' => '', 'expiration' => '']
    ];

    protected $messages = [
        'name' => 'Name is required and should be unique.',
        'email' => 'Email should be unique',
        'phone' => 'Phone is required',
        'insurances.*.vehicle_number.required' => 'Vehicle number is required.',
        'insurances.*.inception.required' => 'Inception date is required.',
        'insurances.*.expiration.required' => 'Expiration date is required.',
        'insurances.*.expiration.after' => 'Expiration must be after the inception date.',
    ];

    public function addInsurance()
    {
        $this->insurances[] = [
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

    public function save()
    {
        $this->validate();

        if ($this->logo) {
            $this->path = $this->uploadSingleImage($this->logo, 'images/companies/logos');
        }

        try {
            DB::transaction(function () {
                $company = Company::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'logo' => $this->path,
                    'address' => $this->address,
                ]);

                foreach ($this->insurances as $insurance) {
                    Insurance::create([
                        'company_id' => $company->id,
                        'vehicle_number' => $insurance['vehicle_number'],
                        'inception' => $insurance['inception'],
                        'expiration' => $insurance['expiration'],
                    ]);
                }
            });

            $this->reset();
            session()->flash('success', 'Company information saved successfully with vehicle insurances.');

        } catch (\Exception $exception) {
            session()->flash('error', "Something went wrong: {$exception->getMessage()}");
        }
    }

    protected function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('companies', 'name'),
            ],
            'email' => 'nullable|string|email|max:1000|unique:companies',
            'phone' => 'required|string|max:1000|unique:companies,phone',
            'ceo' => 'nullable|string|max:1000',
            'address' => 'nullable|string|max:2000',
            'logo' => 'nullable|mimes:jpeg,png,jpg,gif,svg,avif,webp,ico,webp|max:2048',
            'insurances.*.vehicle_number' => 'required|string|max:255|unique:insurances,vehicle_number',
            'insurances.*.inception' => 'required|date|before_or_equal:today',
            'insurances.*.expiration' => 'required|date|after:insurances.*.inception',
        ];
    }

    public function render()
    {
        return view('livewire.companies.create');
    }
}
