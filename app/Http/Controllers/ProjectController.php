<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
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

    public function projectMembers(Request $request)
    {
        try {
            return $this->repository->findMember(\Authorizer::getResourceId(), $request->query->get('limit')); 
        } catch (NoActiveAccessTokenExceptionException $e) {
            return $this->erroMsgm('Usuário não está logado.');
        } catch (\Exception $e) {
            return $this->erroMsgm('Ocorreu um erro ao listar os projetos. Erro: '. $e->getMessage());
        }

    }

    public function store(Request $request)
    {
    	
        try {
            return $this->service->create($request->all());
        } catch (NoActiveAccessTokenException $e) {
            $error = $e->getMessageBag();

            return [
                'error' => true,
                'message' => 'Erro ao cadastrar o porjeto, alguns campos são obrigatórios',
                'messages' => $error->getMessages();
            ];
            
        } catch (\Exception $e) {
            return $this->erroMsgm('Ocorreu um erro ao cadastrar o projeto.');
        }
    }

    public function show($id)
    {
        try {
            return $this->repository->with(['owner', 'client'])->find($id);
            
        } catch (ModelNotFoundException $e) {
            return $this->erroMsgm('Projeto não encontrado.');            
        } catch (NoActiveAccessTokenException $e) {
            return $this->erroMsgm('Usuário não está logado.')
        } catch (\Exception $e) {
            return $this->erroMsgm('Ocorreu um erro ao exibir o projeto.');        
        }
    }

    public function update(Request $request, $id)
    {
    	// if ($this->service->checkProjectOwner($id) == false) {
     //        return ['error' => 'Access forbidden'];
     //    }

     //    

        try {
          return $this->service->update($request->all(), $id);  
        } catch (ModelNotFoundException $e) {
            return $this->erroMsgm('Projeto não encontrado.');            
        } catch (NoActiveAccessTokenException $e) {
            return $this->erroMsgm('Usuário não está logado.');
        } catch (ValidatorException $e) {
            $error = $e->getMessageBag();

            return [
                'error' => true,
                'message' => 'Erro ao atualizar o porjeto, alguns campos são obrigatórios',
                'messages' => $error->getMessages(),
            ];
        } catch (\Exception $e) {
            return $this->erroMsgm('Ocorreu um erro ao atualizar o projeto.');      
        }

    }

    public function destroy($id)
    {
    	try {
           $this->repository->skipPresenter()->find($id)->delete(); 
        } catch (QueryException $e) {
            return $this->erroMsgm('Projeto não poder apagado pois existe um ou mais clientes vinvulados a ele.');
        } catch (ModelNotFoundException $e) {
            return $this->erroMsgm('Projeto não encontrado.');
        } catch (NoActiveAccessTokenException $e) {
            return $this->erroMsgm('Usuário não está logado.');
        } catch (\Exception $e) {
            return $this->erroMsgm('Ocorreu um erro ao excluir o projeto.');
        }
    }

    public function members($id)
    {

    }

    public function addMember($project_id, $member_id)
    {

    }

    public function removeMember($project_id, $member_id)
    {

    }    

    private function erroMsgm($mensagem)
    {
        return [
            'error' => true,
            'message' => $mensagem,
        ];
    }

    
}
