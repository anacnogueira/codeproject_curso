<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectMember extends Model implements Transformable
{
    use TransformableTrait;

    public $timestamps = false;

    protected $fillable = [
    	'project_id',
    	'user_id'
    ];

    public function project()
    {
    	return $this->belongsTo('CodeProject\Entities\Project');
    }

    public function user()
    {
    	return $this->belongsTo('CodeProject\Entities\User');
    }

}
