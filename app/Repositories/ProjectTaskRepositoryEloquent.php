<?php

namespace CodeProject\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Entities\ProjectTask;
use CodeProject\Validators\ProjectTaskValidator;

/**
 * Class ProjectTaskRepositoryEloquent
 * @package namespace CodeProject\Repositories;
 */
class ProjectTaskRepositoryEloquent extends BaseRepository implements ProjectTaskRepository
{
    public function model()
    {
        return ProjectTask::class;
    }

    public function presenter()
    {
    	return ProjectTaskPresenter::class;
    }

    public function boot()
    {
    	$this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }
}
