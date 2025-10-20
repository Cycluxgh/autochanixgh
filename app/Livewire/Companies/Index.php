<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use App\Util;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    use Util;

    public $companies = [];

    public function mount()
    {
        $this->companies = Company::orderBy('name')->get();
    }

    public function delete($companyId)
    {
        $company = Company::firstWhere('id', $companyId);
        if ($company->logo) {
            $path = $this->extractOriginalFilePath($company->logo);
            Storage::disk('public')->delete($path);
        }

        $company->delete();
        session()->flash('success', 'Company information deleted successfully.');
    }

    public function render()
    {
        return view('livewire.companies.index');
    }
}
