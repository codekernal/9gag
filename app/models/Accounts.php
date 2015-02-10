<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Accounts extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'accounts';
    protected $primaryKey = 'id';
    protected $guarded = [];
}