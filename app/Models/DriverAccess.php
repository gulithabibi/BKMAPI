<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class DriverAccess extends BaseModel
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
        'password'
   ];

   public function driver(){
       return $this->belongsTo(DriverAccess::class);
   }
}
