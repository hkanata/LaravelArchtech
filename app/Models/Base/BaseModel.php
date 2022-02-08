<?php
namespace App\Models\Base;

abstract class BaseModel extends Base
{
    /*
    protected $casts = [
        'field' => 'datetime',
        'field' => 'decimal:2',
        'field' => 'date',
    ];
    
    \App\Models\Base\Base::makeQuery("select people_id from peoples") 
    
    */
    private $data;
    
    public function getId($enc = true) {
        if($enc){
            return \App\Http\Operations\Util::enc($this->getKey());
        }else{
            return $this->getKey();
        }
    }
    
    protected function models_save($data) {
        $this->data = $data;
        foreach( $this->getFillable() as $fill ){
            foreach( $this->data as $k => $v ) {
                if( $fill == $k ) {
                   if(isset($this->getCasts()[$k])){
                        if($this->getCasts()[$k]=="datetime"){
                            $this->data[$k] = $this->dateTimeConvert($v);
                        }
                        if($this->getCasts()[$k]=="decimal:2"){
                            $this->data[$k] = $this->decimalConvert($v);
                        }
                        if($this->getCasts()[$k]=="date"){
                            $this->data[$k] = $this->dateConvert($v);
                        }
                   }
                }
            }
        }
        return $this::create($this->data);
    }
    
    protected function models_update($id, $data) {
        $obj = $this::find($id);
        $this->data = $data;
        foreach( $this->getFillable() as $fill ){
            foreach( $this->data as $k => $v ) {
                if( $fill == $k ) {
                    if(isset($this->getCasts()[$k])){
                        if($this->getCasts()[$k]=="datetime"){
                            $obj -> $k = $this->dateTimeConvert($v);
                        }
                        if($this->getCasts()[$k]=="decimal:2"){
                            $obj -> $k = $this->decimalConvert($v);
                        }
                        if($this->getCasts()[$k]=="date"){
                            $obj -> $k = $this->dateConvert($v);
                        }
                    }else{
                        $obj -> $k = $v;
                    }
                }
            }
        }
        $obj->save();
        return $obj;
    }
    
    protected function models_getField($field, $value) {
        return $this::where($field, "=", $value)->get();
    }
    
    protected function models_getAll() {
        return $this::get();
    }

    
    
    protected function models_getById($id) {
        return $this::find($id);
    }
    
    protected function models_delete($id){
        try{
            $obj = $this::find($id);
            if($obj==null){
                throw new \Exception('Registro '.$id.' não existe na base de dados.');
            }
            $obj -> delete();
            return true;
        }catch (\Exception $e){
            throw $e;
        }
    }
    

}
