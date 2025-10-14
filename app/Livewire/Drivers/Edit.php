<?php

namespace App\Livewire\Drivers;

use App\Livewire\Forms\DvlaForm;
use App\Models\Dvla;
use App\Util;
use Livewire\Component;

class Edit extends Component
{
    use Util;

    public ?DvlaForm $form;
    public $customer;

    public function mount(string $dvlaId)
    {
        $dvla = Dvla::firstWhere('id', $this->decrypt($dvlaId));
        $this->customer = $dvla->customer->name;
        $this->form->setDvla($dvla);
    }

    public function update()
    {
        $this->form->update();
        session()->flash('success', 'Dlva information updated successfully.');
    }

    public function render()
    {
        return view('livewire.drivers.edit');
    }
}
