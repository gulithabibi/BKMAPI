<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VehicleServices;

class VehicleController extends Controller
{
    public function index(){
        $vehicles=VehicleServices::find();
        return jsonResult($vehicles);
    }

    public function show($id){
        $vehicle=VehicleServices::findById($id);
        return jsonResult($vehicle);
    }

    public function insert(Request $request){
        $vehicle=VehicleServices::create($request);
        return jsonResult($vehicle);
    }

    public function update(Request $request, $id){
        $vehicle=VehicleServices::update($request,$id);
        return jsonResult($vehicle);
    }

    public function destroy($id){
        $vehicle=VehicleServices::destroy($id);
        return jsonResult($vehicle);
    }

    public function search(Request $request ){
        $vehicles=VehicleServices::search($request);
        return jsonResult($vehicles);
    }
}
