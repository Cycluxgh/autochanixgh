<?php

namespace App\Livewire\Messages;

use App\Models\Customer;
use Livewire\Component;

class Create extends Component
{
    public $customers;
    public $customerContacts;
    public $diagnosis;

    public function mount()
    {
        $this->customers = Customer::orderBy('name')->get();
    }

    public function save()
    {
        dd($this->customerContacts);
    }

    public function render()
    {
        return view('livewire.messages.create');
    }
}
