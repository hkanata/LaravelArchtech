<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $validator;
    public $v = 'index';
    public $param;
    public $field;
    public $trans;
    
    private $_view;
    private $_page;
    private $_builderFields;
    
    private $rexpons;
    
    function __construct(\Request $request) {
        if(count($request::all())>0){
            \App\Http\Operations\Util::globalXssClean();
        }
        
        $this->rexpons = new \App\Http\Requests\Rexpons();
    }
    
    public function setPage($page, array $param = null){
        $this->_page = view($page) -> with($param);
        $this->_view = view($this->v)->with(
            array(
                "page" => view($page) -> with($param)
            )
        );
        return $this;
    }
    
    public function render($type = "html"){
        if($type == "json"){
            return json_encode(array(
                "page" => $this->_page->render()
            ));
        }
        return $this->_view;
    }
    
    public function builderFields(array $fields){
        $this->_builderFields = $fields;
        return $this;
    }
    
    public function setData($data){
        $this->rexpons->setData($data);
    }
    
    public function build(){
        if($this->_builderFields==null){
            $this->rexpons->setSuccess(false);
            $this->rexpons->setErrors(["Nenhum campo para validar"]);
            return false;
        }
        foreach($this->_builderFields as $builder){
            if($builder instanceof \App\Http\Requests\Fields){
                //$builder->setTranslate(utf8_decode($builder->getTranslate()));
                $builder->setTranslate($builder->getTranslate());
                $this->field[$builder->getName()] = $builder->getType();
                $this->trans[$builder->getName()] = $builder->getTranslate();
            }
        }

        $this->validator = \Validator::make(\Request::all(), $this->field, [], $this->trans);
        if ($this->validator->fails()){
            if($this->rexpons instanceof \App\Http\Requests\Rexpons){
                //$m = $this->validator->messages();
                $this->rexpons->setSuccess(false);
                $this->rexpons->setErrors($this->validator->messages()->all());
                $this->rexpons->setMessages($this->validator->messages());
            }
            return false;
        }
        return true;
    }
    
    public function getResponse($resource="json"){
        if($resource instanceof \Exception){
            $this->rexpons->setSuccess(false);
            $this->rexpons->setErrors([$resource->getMessage()]);
            $this->rexpons->setMessages(null);
            return json_encode($this->rexpons->expose());
        }
        //dd($this->rexpons);
        
        if($resource=="json"){
            return json_encode($this->rexpons->expose());
        }
        return $this->rexpons->expose();
    }
  
}
