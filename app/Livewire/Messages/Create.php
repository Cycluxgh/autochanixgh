<?php

namespace App\Livewire\Messages;

use App\Models\Company;
use App\Models\Customer;
use App\Util;
use Livewire\Component;

class Create extends Component
{
    use Util;

    public $customers;
    public $companies;
    public $customerContacts;
    public $companyContacts;
    public $diagnosis;

    public function mount()
    {
        $this->customers = Customer::orderBy('name')->get();
        $this->companies = Company::orderBy('name')->get();
    }

    public function save()
    {
        dd($this->customerContacts, $this->companyContacts);
    }

    public function render()
    {
        return view('livewire.messages.create');
    }
}
