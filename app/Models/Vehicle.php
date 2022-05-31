<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table="vehicle";

    // protected $fillable=[
    //     'vehicle_number',
    //     'terminal',
    //     'vehicle_name',
    //     'expiration_stnk',
    //     'expiration_plate',
    //     'expiration_kir',
    //     'effective_date',
    //     'capacity',
    //     'estimated_load',
    //     'production_year',
    //     'stnk_number',
    //     'body_number',
    //     'temporary_stnk',
    //     'repair_status',
    //     'vehicle_type2',
    //     'is_available',
    //     'description'
    // ];

    protected $guarded=['id'];


}
