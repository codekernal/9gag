<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class SocialLinks extends Eloquent 
{
    public $timestamps = false;	
    protected $table = 'social_links';
    protected $primaryKey = 'id';
    protected $guarded = [];
}