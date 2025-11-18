<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use App\Util;
use Livewire\Component;

class Show extends Component
{
    use Util;

    public ?Company $company;
    public $message;
    public $showRenewals = false;
    public $renewals = [];

    public function mount($companyId)
    {
        $this->company = Company::firstWhere('id', $this->decrypt($companyId));
        $this->renewals = $this->company->renewals;
    }

    public function sendMessage()
    {
        try {
            $success = $this->sendSMSMessage($this->company->phone, $this->message);
            if ($success) {
                session()->flash('success', 'Message sent successfully');
            }

            $this->reset('message');
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.companies.show');
    }
}
