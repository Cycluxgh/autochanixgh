<?php

namespace App\Livewire\Messages;

use App\Models\Company;
use App\Models\Customer;
use App\Util;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    use Util;

    public $customers;
    public $companies;
    public $customerContacts;
    public $companyContacts;
    #[Validate('required|string')]
    public $message;

    public function mount()
    {
        $this->customers = Customer::orderBy('name')->get();
        $this->companies = Company::orderBy('name')->get();
    }

    public function save()
    {
        $this->validate();

        $contacts = [];
        if ($this->customerContacts) {
            foreach ($this->customerContacts as $contact) {
                $contacts[] = $contact;
            }
        }

        if ($this->companyContacts) {
            foreach ($this->companyContacts as $contact) {
                $contacts[] = $contact;
            }
        }

        if (!empty($contacts)) {
            try {
                $success = $this->sendSMSMessage($contacts, $this->message);
                if ($success) {
                    session()->flash('success', 'Message sent successfully');
                }

                $this->reset('message');
            } catch (\Exception $exception) {
                session()->flash('error', $exception->getMessage());
            }
        }
    }

    public function render()
    {
        return view('livewire.messages.create');
    }
}
