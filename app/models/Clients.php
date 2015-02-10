<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Clients extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'clients';
    protected $primaryKey = 'id';
    protected $guarded = [];
}