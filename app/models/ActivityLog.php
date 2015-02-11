<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class ActivityLog extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'activitylog';
    protected $primaryKey = 'id';
    protected $guarded = [];
}