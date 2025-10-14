<?php

namespace App\Livewire\Customers;

use App\CustomerStatusEnum;
use App\Models\Customer;
use App\Util;
use Livewire\Component;

class Index extends Component
{
    use Util;

    public $customers;

    public function mount()
    {
        $this->customers = Customer::with('insurance')
            ->where('status', CustomerStatusEnum::ACTIVE->value)
            ->orderBy('name')
            ->get();
    }

    public function delete($customerId)
    {
        Customer::firstWhere('id', $customerId)->delete();
        session()->flash('success', 'Customer deleted successfully.');
    }

    public function render()
    {
        return view('livewire.customers.index');
    }
}
