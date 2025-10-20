<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use App\Util;
use Livewire\Component;

class Show extends Component
{
    use Util;

    public ?Company $company;
    public $showRenewals = false;
    public $renewals = [];

    public function mount($companyId)
    {
        $this->company = Company::firstWhere('id', $this->decrypt($companyId));
        $this->renewals = $this->company->renewals;
    }

    public function render()
    {
        return view('livewire.companies.show');
    }
}
