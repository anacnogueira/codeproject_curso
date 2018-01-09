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

	public function create(array $data)
	{
		try {
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

			$project = $this->project;
		} catch (Exception $e) {
			
		}
	}

	public function update(array $data, $id)
	{
		try {
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

			return $this->repository->update($data, $id);
		} catch (Exception $e) {
			return [
				'error' =>true,
				'message' => $e->getMessageBag()
			];
		}
	}

	public function delete($id)
	{
		$projectFile = $this->repository->skipPresenter()->find($id);
		if ($this->storage->exists($projectFile->getFileName())) {
			$this->storage->delete($projectFile->getFileName());


			return $projectFile->delete();
		}
	}

	public function getFilePath()
	{

	}

	public function getBasdeURL($projectFile)
	{
		// switch ($this->storage->getDefaultDriver()) {
		// 	case 'local':
		// 		return $this->storage->
		// 		break;
			
		// 	default:
		// 		# code...
		// 		break;
		// }
	}

	public function getFileName()
	{

	}

	public function getMimeType()
	{
		
	}
}