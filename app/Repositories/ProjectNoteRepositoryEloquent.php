<?php

namespace CodeProject\Repositories;

use CodeProject\Presenters\ProjectNotePresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Entities\ProjectNote;


class ProjectNoteRepositoryEloquent extends BaseRepository implements ProjectNoteRepository
{
	public function model()
	{
		return ProjectNote::class;
	}

	public function boot()
	{
		$this->pushCriteria(app(RequestCriteria::class));
	}

	public function presenter()
	{
		return ProjectNotePresenter::class;
	}
}