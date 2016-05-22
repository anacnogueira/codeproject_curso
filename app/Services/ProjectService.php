<?php
namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Repositories\ProjectMembersRepository;
use CodeProject\Validators\ProjectValidator;
use CodeProject\Validators\ProjectMembersValidator;
use \Prettus\Validator\Exceptions\ValidatorException;

class ProjectService
{
	protected $repository;
	protected $repositoryMembers;
	protected $validator;
	protected $validatorMembers;

	public function __construct(
		ProjectRepository $repository, 
		ProjectMembersRepository $repositoryMembers, 
		ProjectValidator $validator,
		ProjectMembersValidator $validatorMembers)
	{
		$this->repository 			= $repository;
		$this->repositoryMembers 	= $repositoryMembers;

		$this->validator 			= $validator;
		$this->validatorMembers 	= $validatorMembers;
	}


	public function find($id){
		return $this->repository->find($id);		
	}

	public function create(array $data)
	{
		try {
			$this->validator->with($data)->passesOrFail();
			return $this->repository->create($data);
			
		} catch (ValidatorException $e) {
			return [
				'error' => true,
				'message' => $e->getMessageBag()
			];
		}

		
	}

	public function update(array $data, $id)
	{
		try {
			$this->validator->with($data)->passesOrFail();
			return $this->repository->update($data, $id);
			
		} catch (ValidatorException $e) {
			return [
				'error' => true,
				'message' => $e->getMessageBag()
			];
		}


	}

	public function addMember(array $data){
		try {
			$this->validatorMembers->with($data)->passesOrFail();
			return $this->repositoryMembers->create($data);
			
		} catch (ValidatorException $e) {
			return [
				'error' => true,
				'message' => $e->getMessageBag()
			];
		}
	}

	public function removeMember($id, $memberId){
		try {
            $member = $this->repositoryMembers->skipPresenter()->findWhere([
    			'project_id'=>$id,
    			'user_id'=>$memberId,
			])->first();
			$this->repositoryMembers->delete($member->id);


			//$member->repositoryMembers->delete($id, $memberId);
            return ['success'=>true, 'Membro removido do projeto com sucesso!'];
        } catch (QueryException $e) {
            return ['error'=>true, 'O membro não pode ser remoovido.'];
        
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Membro não encontrado.'];
        } catch (\Exception $e) {
        	print_r($e->getMessage());
            return ['error'=>true, 'Ocorreu algum erro ao remover o membro.'];
        }
	}

	public function isMember($id, $memberId){
		return $this->repositoryMembers->findWhere([
			'project_id'=>$id,
			'user_id' => $memberId
		]);		
	}

}