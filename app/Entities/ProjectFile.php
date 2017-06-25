<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    protected $fillable = [
    	'name',
    	'description',
    	'extension',
    ];

    public function project()
    {
        return $this->belongsTo('CodeProject\Entities\Project');
    }

   
   	public function getFileName()
   	{
   		return $this->id.".".$this->extension;
   	}
}
