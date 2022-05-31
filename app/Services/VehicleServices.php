<?php

namespace App\Services;

use App\Models\Vehicle;
use App\Libraries\ApiResponse;

class VehicleServices
{
    public function find(){
        $vehicles=Vehicle::where('isactive',1)->get();
        return ApiResponse::getOkResponse($vehicles);
    }

    public function findById($id){
        if(empty($id)) return ApiResponse::getBadRequestResponse();

        $vehicle=Vehicle::find($id);
        if(!isset($vehicle))return ApiResponse::getNotFoundResponse();
        
        return ApiResponse::getOkResponse($vehicle);
    }

    public function create($request){
        VehicleServices::validationCreate($request);

        $vehicle=Vehicle::create($request->all());

        return ApiResponse::getCreatedResponse($vehicle);
    }

    public function update($request,$id){
        VehicleServices::validation($request);

        $vehicle=Vehicle::find($id);
        if(!isset($vehicle))return ApiResponse::getNotFoundResponse();

        $vehicle->update($request->all());

        return ApiResponse::getOkResponse($vehicle);
    }

    public function destroy($id){
        if(!Vehicle::destroy($id)){
            return ApiResponse::getNotFoundResponse();
        }

        return ApiResponse::getOkResponse("","Deleted success");
    }

    public function search($request){
        $vehicles=Vehicle::where('Vehicle_name','like','%'.$request->Vehicle_name.'%',)
                        ->where('isactive',1)
                        ->orwhere('ein',$request->ein)
                        ->orwhere('status',$request->istatus)
                        ->get();

        return ApiResponse::getOkResponse($vehicles);
    }

    public function validationCreate($request){
        $request->validate([
            'vehicle_number'=>'required|string|unique:vehicle',
        ]);

        VehicleServices::validation($request);
    }

    public function validation($request){
        $request->validate([
            'vehicle_number'=>'required|string',
            'stnk_number'=>'required|string',
            'expiration_stnk'=>'required|string',
        ]);
    }
    
}

