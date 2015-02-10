<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class TaskResources extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'task_resources';
    protected $primaryKey = 'id';
    protected $guarded = [];
}