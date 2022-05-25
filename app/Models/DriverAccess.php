<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class DriverAccess extends Model
{
    use HasApiTokens,HasFactory;

    protected $table='driver_access';

    protected $fillable = [
        'id',
        'driver_id',
        'password',
        'username',
        'firebase_token',
        'last_login'
    ];

    protected $hidden =[
        'username',
        'password',
        'created_date',
        'created_by',
        'updated_date',
        'updated_by',
        'isactive'
   ];
}
