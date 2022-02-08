<?php

namespace App\Http\Requests;

class Fields
{
    private $name;
    private $type;
    private $translate;
    
    function __construct($name, $type, $translate) {
        $this->name         = $name;
        $this->type         = $type;
        $this->translate    = $translate;
    }

    public function getName() {
        return $this->name;
    }

    public function getTranslate() {
        return $this->translate;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setTranslate($translate): void {
        $this->translate = $translate;
    }
    
    public function getType() {
        return $this->type;
    }

    public function setType($type): void {
        $this->type = $type;
    }

}
