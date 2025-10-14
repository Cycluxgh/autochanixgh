<?php

namespace App\Livewire\Forms;

use App\Models\dvla;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DvlaForm extends Form
{
    public $customer_id;
    public $vehicle_number;
    public $vehicle_make;
    public $colour;
    public $model;
    public $type;
    public $chassis_number;
    public $origin_country;
    public $manufacture_year;
    public $length;
    public $width;
    public $height;
    public $axles_number;
    public $wheels_number;
    public $front_tyres;
    public $middle_tyres;
    public $rear_tyres;
    public $front_axle_load;
    public $middle_axle_load;
    public $rear_axle_load;
    public $nvm;
    public $gvw;
    public $load;
    public $persons_number;
    public $engine_make;
    public $engine_number;
    public $cylinders_number;
    public $cc;
    public $hp;
    public $fuel;
    public $use;
    public $entry_date;

    public function rules()
    {
        return [
            'customer_id.value' => 'required|numeric|exists:customers,id',
            'vehicle_number' => 'required|string|unique:dvlas,vehicle_number',
            'vehicle_make' => 'required|string',
        ];
    }

    public function store()
    {
        $form = $this->all();
        $form['customer_id'] = $form['customer_id']['value'];
        Dvla::create($form);
        $this->reset();
    }
}
