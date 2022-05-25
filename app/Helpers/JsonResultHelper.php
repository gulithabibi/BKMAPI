<?php 

use Illuminate\Support\Arr;
use Illuminate\Http\Response;

    function jsonResult($response){
        $code=500;
        if(array_key_exists("status",$response)){
            if($response['status']=="OK") $code=200;
            if($response['status']=="Created") $code=201;
            if($response['status']=="NotFound") $code=404;
            if($response['status']=="BadRequest") $code=400;
            if($response['status']=="Unauthorized") $code=401;
        }
        return response($response,$code);
    }

