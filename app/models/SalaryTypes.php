<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class SalaryTypes extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'salary_types';
    protected $primaryKey = 'id';
    protected $guarded = [];
}