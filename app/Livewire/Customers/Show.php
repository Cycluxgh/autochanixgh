<?php

namespace App\Livewire\Customers;

use App\Models\Customer;
use App\Models\Insurance;
use App\Util;
use Livewire\Component;

class Show extends Component
{
    use Util;

    public $showRenewals = false;
    public Customer $customer;
    public ?Insurance $insurance;
    public $renewals = [];

    public function mount($customerId)
    {
        $this->customer = Customer::with(['insurances', 'renewals'])
            ->find($this->decrypt($customerId))->first();
        $insurance = $this->customer->insurance;
        $this->insurance = $insurance;

        $this->renewals = $this->customer->renewals;
    }

    public function render()
    {
        return view('livewire.customers.show');
    }
}
