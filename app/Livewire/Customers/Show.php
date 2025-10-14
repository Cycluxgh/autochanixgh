<?php

namespace App\Livewire\Customers;

use App\Models\Customer;
use App\Models\Insurance;
use App\Util;
use Livewire\Component;

class Show extends Component
{
    use Util;

    public string $customerId;
    public Customer $customer;
    public ?Insurance $insurance;

    public function mount($customerId)
    {
        $this->customer = Customer::with('insurance')
            ->find($this->decrypt($customerId));
        $insurance = $this->customer->insurance;
        $this->insurance = $insurance;
    }

    public function render()
    {
        return view('livewire.customers.show');
    }
}
