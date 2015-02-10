<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Days extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'days';
    protected $primaryKey = 'id';
    protected $guarded = [];
}