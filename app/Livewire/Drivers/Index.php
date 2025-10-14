<?php

namespace App\Livewire\Drivers;

use App\Models\dvla;
use Livewire\Component;

class Index extends Component
{
    public $dvlas;

    public function mount()
    {
        $this->dvlas = Dvla::orderBy('id', 'desc')->get();
    }

    public function delete($id)
    {
        Dvla::firstWhere('id', $id)->delete();
        session()->flash('success', 'Dvla information deleted successfully.');
    }

    public function render()
    {
        return view('livewire.drivers.index');
    }
}
