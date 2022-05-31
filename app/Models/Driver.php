<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends BaseModel
{
    use HasFactory;

    protected $table="driver";

    // protected $fillable = [
    //     'ein',
    //     'vehicle_id',
    //     'driver_name',
    //     'email',
    //     'date_of_birth',
    //     'gender',
    //     'nik',
    //     'ktp_number',
    //     'sim_number',
    //     'insentif',
    //     'bpjs_number_employment',
    //     'bpjs_number_health',
    //     'kk_number',
    //     'telp_number',
    //     'norek',
    //     'active_working_date',
    //     'address',
    //     'blood_type',
    //     'status',
    //     'status_desc',
    //     'is_still_driving',
    //     'description',
    // ];
        
    protected $guarded=['id'];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
}
