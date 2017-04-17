<?php

namespace CodeProject\Repositories;

use CodeProject\Entities\ProjectMember;
use CodeProject\Presenters\ProjectMemberPresenter;
use Prettus\Repository\Eloquent\BaseRepository;


/**
 * Class ProjectMembersRepositoryEloquent
 * @package namespace CodeProject\Repositories;
 */
class ProjectMembersRepositoryEloquent extends BaseRepository implements ProjectMembersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectMember::class;
    }


    public function presenter()
    {
        return ProjectMemberPresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(\Prettus\Repository\Criteria\RequestCriteria::class));
    }
}
