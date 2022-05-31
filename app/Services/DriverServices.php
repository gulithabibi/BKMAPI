<?php

namespace App\Services;

use App\Models\Driver;
use App\Libraries\ApiResponse;

class DriverServices
{
    public function find(){
        $drivers=Driver::where('isactive',1)->get();
        return ApiResponse::getOkResponse($drivers);
    }

    public function findById($id){
        if(empty($id)) return ApiResponse::getBadRequestResponse();

        $driver=Driver::find($id);
        if(!isset($driver))return ApiResponse::getNotFoundResponse();
        
        // $driver['vehicle']=$driver->vehicle();

        return ApiResponse::getOkResponse($driver);
    }

    public function create($request){
        self::validationCreate($request);

        $driver=Driver::create($request->all());

        return ApiResponse::getCreatedResponse($driver);
    }

    public function update($request,$id){
        self::validation($request);

        $driver=Driver::find($id);
        if(!isset($driver))return ApiResponse::getNotFoundResponse();

        $driver->update($request->all());

        return ApiResponse::getOkResponse($driver);
    }

    public function destroy($id){
        if(!Driver::destroy($id)){
            return ApiResponse::getNotFoundResponse();
        }

        return ApiResponse::getOkResponse("","Deleted success");
    }

    public function search($request){
        $drivers=Driver::where('driver_name','like','%'.$request->driver_name.'%',)
                        ->where('isactive',1)
                        ->orwhere('ein',$request->ein)
                        ->orwhere('status',$request->istatus)
                        ->get();

        return ApiResponse::getOkResponse($drivers);
    }

    public function validationCreate($request){
        $request->validate([
            'ein'=>'required|string|unique:driver',
        ]);

        DriverServices::validation($request);
    }

    public function validation($request){
        $request->validate([
            'ein'=>'required|string',
            'driver_name'=>'required|string',
            'gender'=>'required|string',
            'nik'=>'required|string',
            'ktp_number'=>'required|string',
            'sim_number'=>'required|string',
            'blood_type'=>'integer'
        ]);
    }
    
}

