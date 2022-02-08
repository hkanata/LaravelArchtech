<?php

namespace App\Models\Base;
use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    protected function dateConvert($date){
        return \App\Http\Operations\Util::dateToDefault($date);
    }
    protected function dateTimeConvert($dateTime){
        return \App\Http\Operations\Util::dateTimeToDefault($dateTime);
    }
    protected function decimalConvert($valor){
        return \App\Http\Operations\Util::toDecimal($valor);
    }
    protected function makeQuery($sql) {
        return \DB::select($sql);
    }
}
