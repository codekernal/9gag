<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Persons extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'persons';
    protected $primaryKey = 'id';
    protected $guarded = [];
}