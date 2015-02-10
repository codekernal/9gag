<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Projects extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'projects';
    protected $primaryKey = 'id';
    protected $guarded = [];
}