<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class PersonEducations extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'person_educations';
    protected $primaryKey = 'id';
    protected $guarded = [];
}