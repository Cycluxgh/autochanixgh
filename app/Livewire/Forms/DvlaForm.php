<?php

namespace App\Livewire\Forms;

use App\Models\Dvla;
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
    public $nvw;
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
    public ?Dvla $dvla;

    public function rules()
    {
        return [
            'customer_id.value' => 'required|numeric|exists:customers,id',
            'vehicle_number' => 'required|string|unique:dvlas,vehicle_number',
            'vehicle_make' => 'required|string',
        ];
    }

    public function setDvla(Dvla $dvla)
    {
        $this->dvla = $dvla;
        $this->vehicle_number = $dvla->vehicle_number;
        $this->vehicle_make = $dvla->vehicle_make;
        $this->colour = $dvla->colour;
        $this->model = $dvla->model;
        $this->type = $dvla->type;
        $this->chassis_number = $dvla->chassis_number;
        $this->origin_country = $dvla->origin_country;
        $this->manufacture_year = $dvla->manufacture_year;
        $this->length = $dvla->length;
        $this->width = $dvla->width;
        $this->height = $dvla->height;
        $this->axles_number = $dvla->axles_number;
        $this->wheels_number = $dvla->wheels_number;
        $this->front_tyres = $dvla->front_tyres;
        $this->middle_tyres = $dvla->middle_tyres;
        $this->rear_tyres = $dvla->rear_tyres;
        $this->front_axle_load = $dvla->front_axle_load;
        $this->middle_axle_load = $dvla->middle_axle_load;
        $this->rear_axle_load = $dvla->rear_axle_load;
        $this->nvw = $dvla->nvw;
        $this->gvw = $dvla->gvw;
        $this->load = $dvla->load;
        $this->persons_number = $dvla->persons_number;
        $this->engine_make = $dvla->engine_make;
        $this->engine_number = $dvla->engine_number;
        $this->cylinders_number = $dvla->cylinders_number;
        $this->cc = $dvla->cc;
        $this->hp = $dvla->hp;
        $this->fuel = $dvla->fuel;
        $this->use = $dvla->use;
        $this->entry_date = $dvla->entry_date;
    }

    public function store()
    {
        $form = $this->all();
        $form['customer_id'] = $form['customer_id']['value'];
//        $form['vehicle_number'] = $form['vehicle_number']['value'];

        Dvla::create($form);
        $this->reset(
  'vehicle_make',
            'colour',
            'model',
            'type',
            'chassis_number',
            'origin_country',
            'manufacture_year',
            'length',
            'width',
            'height',
            'axles_number',
            'wheels_number',
            'front_tyres',
            'middle_tyres',
            'rear_tyres',
            'front_axle_load',
            'middle_axle_load',
            'rear_axle_load',
            'nvw',
            'gvw',
            'load',
            'persons_number',
            'engine_make',
            'engine_number',
            'cylinders_number',
            'cc',
            'hp',
            'fuel',
            'use',
            'entry_date',
        );
    }

    public function update()
    {
        $this->dvla->update($this->except('customer_id'));
    }
}
