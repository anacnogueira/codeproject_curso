<?php
namespace CodeProject\Services;

use	Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use CodeProject\Validators\ProjectFileValidator;
use \Prettus\Validator\Exceptions\ValidatorException;

class ProjectService
{
	protected $repository;
	protected $validator;
	protected $fileValidator;
	protected $storage;
	protected $fileSystem;


	public function __construct(
		ProjectRepository $repository, 
		ProjectValidator $validator,
		ProjectFileValidator $fileValidator,
		Filesystem $filesystem,
		Storage $storage)
	{
		$this->repository 			= $repository;
		$this->validator 			= $validator;
		$this->fileValidator 		= $fileValidator;
		$this->filesystem 			= $filesystem;
		$this->storage 				= $storage;
	}



	public function create(array $data)
	{
		try {
			$this->validator->with($data)->passesOrFail();
			return $this->repository->create($data);
			
		} catch (ValidatorException $e) {
			$error = $e->getMessageBag();

			return [
				'error' => true,
				'message' => 'Erro ao cadastra o projeto, alguns campos são obrigatórios!',
				'messages' => $error->getMessages()
			];
		}		
	}

	public function update(array $data, $id)
	{
		try {
			$this->validator->with($data)->passesOrFail();
			return $this->repository->update($data, $id);
			
		} catch (ValidatorException $e) {
			$error = $e->getMessageBag();

			return [
				'error' => true,
				'message' => 'Erro ao atualizar o projeto, alguns campos são obrigatórios!',
				'messages' => $error->getMessages()
			];
		}
	}

	public function addMember($project_id, $member_id)
	{
		$project = $this->repository->find($project_id);

		if (!$this->isMember($project_id, $member_id)) {
			$project->members()->attach($member_id);
		}

		return $project->members()->get();
	}

	public function removeMember($project_id, $member_id)
	{
		$project = $this->repository->find($project_id);
		$project->members()->detach($member_id);
		return $project->members()->get();
	}

	public function isMember($project_id, $member_id)
	{
		$project = $this->repository->find($project_id)->members()->find(['member_id' => $member_id]);

		if (count($project)) {
			return true;
		}			

		return false;
	}

	

	private function checkProjectOwner($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();

        return $this->repository->isOwner($projectId, $userId);       
    }

    private function checkProjectMember($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();

        return $this->repository->hasMember($projectId, $userId);       
    }

    private function checkProjectPermissions($projectId)
    {
        if ($this->checkProjectOwner($projectId) || $this->checkProjectMember($projectId)){
            return true;
        }

        return false;
    }

}