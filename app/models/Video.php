<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Video extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'video';
    protected $primaryKey = 'id';
    protected $guarded = [];
}