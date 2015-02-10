<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class PublicHolidays extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'public_holidays';
    protected $primaryKey = 'id';
    protected $guarded = [];
}