<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Task extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $guarded = [];
}