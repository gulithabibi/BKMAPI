<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DriverServices;

class DriverController extends Controller
{
    public function register(Request $request){
        $response=DriverServices::register($request);
        return jsonResult($response);
    }

    public function index(){
        $drivers=DriverServices::find();
        return jsonResult($drivers);
    }

    public function show($id){
        $driver=DriverServices::findById($id);
        return jsonResult($driver);
    }

    public function insert(Request $request){
        $driver=DriverServices::create($request);
        return jsonResult($driver);
    }

    public function update(Request $request, $id){
        $driver=DriverServices::update($request,$id);
        return jsonResult($driver);
    }

    public function destroy($id){
        $driver=DriverServices::destroy($id);
        return jsonResult($driver);
    }

    public function search(Request $request ){
        $drivers=DriverServices::search($request);
        return jsonResult($drivers);
    }
}
