<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Trend extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'trend';
    protected $primaryKey = 'id';
    protected $guarded = [];
}