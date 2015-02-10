<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Education extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'education';
    protected $primaryKey = 'id';
    protected $guarded = [];
}