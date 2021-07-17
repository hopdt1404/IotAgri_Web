<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantStateInfo extends Model
{

    protected $fillable = [
        'plant_state_id',
        'plant_id',
        'growth_period_state',
        'temperature',
        'moisture',
        'light',
        'note',
        'created_at',
        'created_user',
        'updated_user',
        'updated_at',
    ];
}
