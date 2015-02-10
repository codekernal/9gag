<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Category extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $guarded = [];
}