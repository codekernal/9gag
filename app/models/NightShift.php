<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class NightShift extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'night_shift';
    protected $primaryKey = 'id';
    protected $guarded = [];
}