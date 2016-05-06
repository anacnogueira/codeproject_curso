<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function owner()
    {
        return $this->belongsTo('CodeProject\Entities\User');
    }

    public function client()
    {
        return $this->belongsTo('CodeProject\Entities\Client');
    }

    protected $fillable = [
    	'owner_id',
    	'client_id',
    	'name',
    	'description',
    	'progress',
    	'status',
    	'due_date'
    ];
}
