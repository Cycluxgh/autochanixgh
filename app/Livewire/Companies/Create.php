<?php

namespace App\Livewire\Companies;

use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $email;
    public $phone;
    public $ceo;
    #[Validate('image|max:2048|mimes:jpeg,png,jpg,gif,svg,avif,webp')]
    public $logo;
    public $address;

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
        dd($this->name);
    }

    public function render()
    {
        return view('livewire.companies.create');
    }
}
