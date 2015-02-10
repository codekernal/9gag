<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Services extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $guarded = [];
}