<?php

namespace App\Livewire\Customers;

use App\Models\Customer;
use App\Models\Insurance;
use App\Util;
use Illuminate\Support\Facades\DB;
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
    #[Validate('image|max:2048|mimes:jpeg,png,jpg,gif,svg,avif,webp')]
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
    public string $customerId;

    public function mount($customerId)
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

    public function update()
    {
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

    public function render()
    {
        return view('livewire.customers.edit');
    }
}
