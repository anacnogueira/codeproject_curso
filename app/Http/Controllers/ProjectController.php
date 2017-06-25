<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Http\Requests;
use CodeProject\Services\ProjectService;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Repositories\ProjectTaskRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use LucaDegasperi\OAuth2Server\Exceptions\NoActiveAccessTokenException;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectController extends Controller
{
    private $repository;
    private $service;
    private $taskRepository;

    public function __construct(ProjectRepository $repository, ProjectService $service, ProjectTaskRepository $taskRepository)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->taskRepository = $taskRepository;
    }

    public function index(Request $request)
    {
    	try {
            return $this->repository->findOwner(Authorizer::getResourceOwnerId(), $request->query->get('limit'));
        } catch (NoActiveAccessTokenException $e) {
            return $this->erroMsgm('Usuário não está logado.');
        } catch (\Exception $e) {
            return $this->erroMsgm('Ocorreu um erro ao listar os projetos. Erro: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
    	return $this->service->create($request->all());
    }

    public function show($id)
    {
        if ($this->checkProjectPermissions($id) == false) {
            return ['error' => 'Access forbidden'];
        }

        return $this->service->find($id);
    }

    public function update(Request $request, $id)
    {
    	if ($this->checkProjectOwner($id) == false) {
            return ['error' => 'Access forbidden'];
        }

        return $this->service->update($request->all(), $id);

    }

    public function destroy($id)
    {
    	if ($this->checkProjectPermissions($id) == false) {
            return ['error' => 'Access forbidden'];
        }

        try {
            $this->repository->find($id)->delete();
            return ['success'=>true, 'Projeto deletado com sucesso!'];
        } catch (QueryException $e) {
            return ['error'=>true, 'Projeto não pode ser apagado pois existe um ou mais clientes vinculados a ele.'];
        
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Projeto não encontrado.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao excluir o projeto.'];
        }
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

        private function erroMsgm($mensagem)
    {
        return [
            'error' => true,
            'message' => $mensagem,
        ];
    }

    
}
