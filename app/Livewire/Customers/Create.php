<?php

namespace App\Livewire\Customers;

use App\GenderEnum;
use App\MaritalStatusEnum;
use App\Models\Customer;
use App\Models\Insurance;
use App\Util;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads, Util;

    public $name;
    public $phone;
    public $email;
    public $gender;
    public $marital_status;
    public $work_place;
    public $address;
    #[Validate('nullable|image|max:2048|mimes:jpeg,png,jpg,gif,svg,avif,webp')]
    public $image;
    private $path;

    public $insurances = [
        ['vehicle_number' => '', 'inception' => '', 'expiration' => '']
    ];

    protected $messages = [
        'name' => 'Name is required',
        'email' => 'Email should be unique',
        'phone' => 'Phone is required and should be unique',
        'gender.enum' => 'Invalid gender selection.',
        'marital_status.enum' => 'Invalid marital status selection.',
        'insurances.*.vehicle_number.required' => 'Vehicle number is required.',
        'insurances.*.vehicle_number.unique' => 'Vehicle number already exists.',
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

        if ($this->image) {
            $this->path = $this->uploadSingleImage($this->image, 'images/customers');
        }

        try {
            DB::transaction(function () {
                $customer = Customer::create([
                    'user_id' => auth()->id(),
                    'name' => $this->name,
                    'phone' => $this->phone,
                    'email' => $this->email,
                    'gender' => $this->gender,
                    'marital_status' => $this->marital_status,
                    'work_place' => $this->work_place,
                    'address' => $this->address,
                    'image' => $this->path,
                ]);

                foreach ($this->insurances as $insurance) {
                    Insurance::create([
                       'customer_id' => $customer->id,
                       'vehicle_number' => $insurance['vehicle_number'],
                       'inception' => $insurance['inception'],
                       'expiration' => $insurance['expiration'],
                    ]);
                }
            });

            $this->reset();
            session()->flash('success', 'Customer information saved successfully with vehicle insurances.');
        } catch (\Exception $e) {
            session()->flash('error', "Something went wrong: {$e->getMessage()}");
        }
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:1000',
            'email' => 'nullable|email|max:1000|unique:customers,email',
            'phone' => 'required|string|max:1000|unique:customers,phone',
            'gender' => ['nullable', Rule::enum(GenderEnum::class)],
            'marital_status' => ['nullable', Rule::enum(MaritalStatusEnum::class)],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'work_place' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'insurances.*.vehicle_number' => 'required|string|max:255|unique:insurances,vehicle_number',
            'insurances.*.inception' => 'required|date|before_or_equal:today',
            'insurances.*.expiration' => 'required|date|after:insurances.*.inception',
        ];
    }

    public function render()
    {
        return view('livewire.customers.create');
    }
}
