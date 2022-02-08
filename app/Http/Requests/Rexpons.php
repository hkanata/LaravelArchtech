<?php

namespace App\Http\Requests;

class Rexpons
{
    private $success = true;
    
    private $data;
    
    private $errors = array();
    private $messages = array();
    
    public static function getResponse(){
        return $this->expose();
    }

    public function getSuccess() {
        return $this->success;
    }

    public function expose() {
        return get_object_vars($this);
    }

    public function getErrors() {
        return $this->errors;
    }

    public function setSuccess($success): void {
        $this->success = $success;
    }

    public function setErrors($errors): void {
        $this->errors = $errors;
    }
    public function getMessages() {
        return $this->messages;
    }

    public function setMessages($messages): void {
        $this->messages = $messages;
    }
    
    public function getData() {
        return $this->data;
    }

    public function setData($data): void {
        $this->data = $data;
    }


}
