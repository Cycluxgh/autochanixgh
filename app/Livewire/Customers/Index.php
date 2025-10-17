<?php

namespace App\Livewire\Customers;

use App\CustomerStatusEnum;
use App\Models\Customer;
use App\Util;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    use Util;

    public $customers;

    public function mount()
    {
        $this->customers = Customer::with('insurances')
            ->where('status', CustomerStatusEnum::ACTIVE->value)
            ->orderBy('name')
            ->get();
    }

    public function delete($customerId)
    {
        $customer = Customer::firstWhere('id', $customerId);
        if ($customer->image) {
            $path = str_replace('storage/', '', $customer->image);
            Storage::disk('public')->delete($path);
        }

        $customer->delete();
        session()->flash('success', 'Customer deleted successfully.');
    }

    public function render()
    {
        return view('livewire.customers.index');
    }
}
