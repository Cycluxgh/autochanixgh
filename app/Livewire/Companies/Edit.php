<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use App\Util;
use Illuminate\Support\Facades\DB;
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
    #[Validate('image|max:2048|mimes:jpeg,png,jpg,gif,svg,avif,webp')]
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
        'phone' => 'Phone is required',
        'insurances.*.vehicle_number.required' => 'Vehicle number is required.',
        'insurances.*.inception.required' => 'Inception date is required.',
        'insurances.*.expiration.required' => 'Expiration date is required.',
        'insurances.*.expiration.after' => 'Expiration must be after the inception date.',
    ];

    public function mount(string $companyId)
    {
        $this->company = Company::firstWhere('id', $companyId);
        $this->name = $this->company->name;
        $this->email = $this->company->email;
        $this->phone = $this->company->phone;
        $this->ceo = $this->company->ceo;
        $this->logo = $this->company->logo;
        $this->address = $this->company->address;

        $this->insurances = $this->company->insurances->map(function ($insurance) {
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
        $this->validate();

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
                    'logo' => $this->path,
                    'address' => $this->address,
                ]);

                $upsertData = collect($this->insurances)->map(function ($insurance) {
                    return array_merge($insurance, [
                        'customer_id' => $this->company->id,
                    ]);
                })->toArray();

                $uniqueColumns = ['id'];
                $updateColumns = ['vehicle_number', 'inception', 'expiration'];

                Company::upsert($upsertData, $uniqueColumns, $updateColumns);
            });

            session()->flash('success', 'Company information updated successfully with vehicle insurances.');

        } catch (\Exception $exception) {
            session()->flash('error', "Something went wrong: {$exception->getMessage()}");
        }
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:1000',
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
        return view('livewire.companies.edit');
    }
}
