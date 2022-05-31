<?php 

namespace App\Libraries;

class ApiResponse{

    function __construct(){
        parent::__construct();
    }

    public function getCreatedResponse($resp,$msg=""){
        return array(
            "status"=>"Created",
            "time"=>currentDatetime(),
            "data"=>$resp,
            "message"=>$msg
        );
    }

    public function getOkResponse($resp,$msg=""){
        return array(
            "status"=>"OK",
            "time"=>currentDatetime(),
            "data"=>$resp,
            "message"=>$msg
        );
    }

    public function getErrorResponse($status, $msg,$errors=""){
        return array(
            "status"=>$status,
            "time"=>currentDatetime(),
            "message"=>$msg,
            "errors"=>$errors
        );
    }

    public function getNotFoundResponse($msg=""){
        if(empty($msg)) $msg="Data Not Found";
        return ApiResponse::getErrorResponse("NotFound",$msg);
    }

    public function getBadRequestResponse($msg=""){
        if(empty($msg)) $msg="Bad Request";
        return ApiResponse::getErrorResponse("BadRequest",$msg);
    }

    public function getUnauthorizedResponse($msg=""){
        if(empty($msg)) $msg="Unauthorized";
        return ApiResponse::getErrorResponse("Unauthorized",$msg);
    }
}