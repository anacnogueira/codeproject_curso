<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
    	'owner_id',
    	'client_id',
    	'name',
    	'description',
    	'progress',
    	'status',
    	'due_date'
    ];

    public function owner()
    {
        return $this->belongsTo('CodeProject\Entities\User');
    }

    public function client()
    {
        return $this->belongsTo('CodeProject\Entities\Client');
    }

    public function notes()
    {
        return $this->hasMany('CodeProject\Entities\ProjectNote');
    }

    public function tasks()
    {
        return $this->hasMany('CodeProject\Entities\ProjectTask');
    }

    public function members()
    {
        return $this->hasMany('CodeProject\Entities\Projectmembers');
    }
}
