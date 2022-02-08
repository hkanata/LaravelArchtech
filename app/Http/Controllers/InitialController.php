<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class InitialController extends Controller
{
    
    public function index(){
        return $this->setPage("contato", array(
            "nome" => "Leonardo Miyamoto",
            "arrais" => array(
                "uma", 
                "duas"
            )
        ))->render();
    }
    
    public function curso(){
       return $this->setPage("angularjs", array(
            "nome" => "Moicano",
            "arrais" => array(
                "uma", "duas"
            )
        ))->render();
    }
    
    public function doMake(){
        echo "doMake";
    }
    
    public function validarInput(){
        
        try{
            \Request::merge(array("proced_namex" => "nome"));
        
            $build = $this->builderFields(array(
                new \Fields("proced_namex", "required", "ão ID Procedimento"),
            ))->build();
            
            if(!$build){
                throw new \Exception("Nada a Declarar");
            }
            
            $data = \App\Models\Peoples::models_getById(1);
            
            $this->setData($data);

            return $this->getResponse();
        
        } catch (\Exception $e){
            return $this->getResponse($e);
        }
    }
   
}
