<?php

namespace App\Models;
use App\Models\Base\BaseModel;

class Peoples extends BaseModel
{
    protected $primaryKey = 'people_id';
    
    protected $table = 'peoples';
    
    public $timestamps = true;
    
    protected $fillable = [
        'people_name',
        'people_birtdate',
        'niver',
        'valor',
        'datax',
    ];
    
    protected $casts = [
        'people_birtdate'   => 'datetime',
        'niver'             => 'datetime',
        'valor'             => 'decimal:2',
        'datax'             => 'date',
    ];
}
