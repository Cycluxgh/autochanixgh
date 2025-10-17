<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use App\Util;
use Livewire\Component;

class Show extends Component
{
    use Util;

    public ?Company $company;

    public function mount($companyId)
    {
        $this->company = Company::firstWhere('id', $this->decrypt($companyId));
    }

    public function render()
    {
        return view('livewire.companies.show');
    }
}
