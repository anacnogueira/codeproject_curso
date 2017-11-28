<?php

namespace CodeProject\Repositories;

use CodeProject\Validators\ClientValidator;
use Prettus\Repository\Eloquent\RequestCriteria;
use CodeProject\Entities\Project;
use Prettus\Repository\Eloquent\BaseRepository;
use CodeProject\Presenters\ProjectPresenter;

class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
	public function model()
	{
		return Project::class;
	}

	public function boot()
	{
		$this->pushCriteria(app(RequestCriteria::class));
	}

	
	public function isOwner($projectId, $userId)
	{
		if (count($this->skipPresenter()->findWhere(['id' => $projectId, 'owner_id' => $userId])) )
			return true;

		return false;

	}

	public function hasMember($projectId, $memberId)
	{
		$project = $this->skipPresenter()->find($projectId);

		foreach ($project->members as $member) {
			if ($member->id == $memberId){
				return true;
			}
		}

		return false;
	}

	public function findOwner($userId, $limit = null, $columns = []){
        return $this->scopeQuery(function($query) use($userId){
            return $query->select('projects.*')->where('owner_id','=',$userId);
        })->paginate($limit,$columns);
    }

    public function findMember($userId, $limit = null, $columns = [])
    {
    	return $this->scopeQuery(function($query) use ($userId) {
    		return $query->select('projects.*')->leftJoin('project_members','project_members.project_id','=','projects.id')
    			->where('project_members.member_id','=', $userId);
    	})->paginate($limit, $columns);
    }

    public function findWithOwnerAndMember($userId)
    {
    	return $this->scopeQuery(function($query) use ($userId) {
    		return $query->select('projects.*')->leftJoin('project_members', 'project_members.project_id','=','projects.id')
    			->where('project_members.member_id','=',$userId)
    			->union($this->model->query()->getQuery()->where('owner_id','=',$userId))
    	})->all();
    }


	public function presenter()
	{
		return ProjectPresenter::class;
	}

	public function validator()
	{
		return \CodeProject\Validators\ProjectValidator::class;
	}
}