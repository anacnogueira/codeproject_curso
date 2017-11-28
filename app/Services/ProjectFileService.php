<?php
namespace CodeProject\Services;

use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectFileValidator;
use Illuminate\Container\Filesystem\Factory;
use Illuminate\Filesystem\Filesystem;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectFileService
{
	

	protected $repository;
	protected $fileValidator;
	protected $storage;
	protected $fileSystem;

	public function __construct()
	{

	}

	public function create()
	{

	}

	public function update()
	{

	}

	public function delete($id)
	{
		$projectFile = $this->repository->skipPresenter()->find($id);
		if ($this->storage->exists()) {

		}
	}

	public function getFilePath()
	{

	}

	public function getBasdeURL()
	{

	}

	public function getFileName()
	{

	}

	public function getMimeType()
	{
		
	}
}