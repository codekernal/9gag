<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Vehicle extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'vehicle';
    protected $primaryKey = 'id';
    protected $guarded = [];
}