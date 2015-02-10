<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class ProjectServices extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'project_services';
    protected $primaryKey = 'id';
    protected $guarded = [];
}