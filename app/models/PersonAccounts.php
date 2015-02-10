<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class PersonAccounts extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'person_accounts';
    protected $primaryKey = 'id';
    protected $guarded = [];
}