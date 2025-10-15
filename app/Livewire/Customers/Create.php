<?php

namespace App\Livewire\Customers;

use App\Models\Customer;
use App\Models\Insurance;
use App\Util;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads, Util;

    public $name;
    #[Validate("required|exists:customers,phone")]
    public $phone;
    #[Validate("nullable|exists:customers,email")]
    public $email;
    public $gender;
    public $marital_status;
    public $work_place;
    public $address;
    #[Validate('image|max:2048|mimes:jpeg,png,jpg,gif,svg,avif,webp')]
    public $image;
    private $path;

    public $insurances = [
        ['vehicle_number' => '', 'inception' => '', 'expiration' => '']
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
            session()->flash('success', 'Customer information saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', "Something went wrong: {$e->getMessage()}");
        }

    }

    public function render()
    {
        return view('livewire.customers.create');
    }
}
