<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Dvla extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'vehicle_number',
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
        'entry_date'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
