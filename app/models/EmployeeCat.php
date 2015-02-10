<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class EmployeeCat extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'employee_cat';
    protected $primaryKey = 'id';
    protected $guarded = [];
}