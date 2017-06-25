<?php

namespace CodeProject\Repositories;

use CodeProject\Entities\User;
use CodeProject\Presenters\UserPresenter;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
	
	protected $fieldSearchable = [
		'name'
	];

	public function model()
	{
		return User::class;
	}	

	public function validator()
	{
		return \CodeProject\Validators\UserValidator::class; 
	}

	public function presenter()
	{
		return UserPresenter::class;
	}

	public function boot()
	{
		$this->pushCriteria(app(\Prettus\Repository\Criteria\RequestCriteria::class));
	}
}