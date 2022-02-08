<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TesteController extends Controller
{
    public function welcomex(){
        //echo "ae";
        echo \Request::get("nome");
        return view('welcome');
    }
    
    public function index(){

        $r = \App\Models\Base\Base::makeQuery("select people_id from peoples");
        print_r($r);
        
    }
    
   
}
