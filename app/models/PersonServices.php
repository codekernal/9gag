<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class PersonServices extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'person_services';
    protected $primaryKey = 'id';
    protected $guarded = [];
}