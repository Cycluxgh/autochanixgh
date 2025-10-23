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
use function PHPSTORM_META\map;

class Edit extends Component
{
    use Util, WithFileUploads;

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
        [
            'id' => '',
            'vehicle_number' => '',
            'inception' => '',
            'expiration' => '',
        ]
    ];

    public Customer $customer;

    protected $messages = [
        'name' => 'Name is required',
        'email' => 'Email should be unique',
        'phone' => 'Phone is required',
        'gender.enum' => 'Invalid gender selection.',
        'marital_status.enum' => 'Invalid marital status selection.',
        'insurances.*.vehicle_number.required' => 'Vehicle number is required.',
        'insurances.*.inception.required' => 'Inception date is required.',
        'insurances.*.expiration.required' => 'Expiration date is required.',
        'insurances.*.expiration.after' => 'Expiration must be after the inception date.',
    ];

    public function mount(string $customerId)
    {
        $this->customer = Customer::find($this->decrypt($customerId));
        $this->name = $this->customer->name;
        $this->phone = $this->customer->phone;
        $this->email = $this->customer->email;
        $this->gender = $this->customer->gender;
        $this->marital_status = $this->customer->marital_status;
        $this->work_place = $this->customer->work_place;
        $this->address = $this->customer->address;

        $this->insurances = $this->customer->insurances->map(function ($insurance) {
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

        if ($this->image) {
            $this->path = $this->uploadSingleImage($this->image, 'images/customers');
        }

        try {
            DB::transaction(function () {
                $this->customer->update([
                    'user_id' => auth()->id(),
                    'name' => $this->name,
                    'phone' => $this->phone,
                    'email' => $this->email,
                    'gender' => $this->gender,
                    'marital_status' => $this->marital_status,
                    'work_place' => $this->work_place,
                    'address' => $this->address,
                    'image' => $this->path ?: $this->customer->image,
                ]);

                $upsertData = collect($this->insurances)->map(function ($insurance) {
                    return array_merge($insurance, [
                        'customer_id' => $this->customer->id,
                    ]);
                })->toArray();

                $uniqueColumns = ['id'];
                $updateColumns = ['vehicle_number', 'inception', 'expiration'];

                Insurance::upsert($upsertData, $uniqueColumns, $updateColumns);

            });

            session()->flash('success', 'Customer information updated successfully.');
        } catch (\Exception $e) {
            session()->flash('error', "Something went wrong: {$e->getMessage()}");
        }

    }

    protected function rules()
    {
        $customerId = $this->customerId ?? $this->customer->id ?? null;

        return [
            'name' => 'required|string|max:1000',
            'email' => ['nullable', 'email', Rule::unique('customers', 'email')->ignore($customerId)],
            'phone' => ['required', 'string', Rule::unique('customers', 'phone')->ignore($customerId)],
            'gender' => ['nullable', Rule::enum(GenderEnum::class)],
            'marital_status' => ['nullable', Rule::enum(MaritalStatusEnum::class)],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'work_place' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
//            'insurances.*.vehicle_number' => [
//                'required',
//                'string',
//                'max:255',
//                Rule::unique('insurances', 'vehicle_number')->ignore($customerId),
//            ],
            'insurances.*.inception' => 'required|date|before_or_equal:today',
            'insurances.*.expiration' => 'required|date|after:insurances.*.inception',
        ];
    }

    public function render()
    {
        return view('livewire.customers.edit');
    }
}
