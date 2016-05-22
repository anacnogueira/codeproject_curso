<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Services\ProjectTaskService;
use CodeProject\Repositories\ProjectTaskRepository;


class ProjectTaskController extends Controller
{

    /**
     * @var ProjectTaskRepository
     */
    protected $repository;

    /**
     * @var ProjectTaskValidator
     */
    protected $validator;   


   public function __construct(ProjectTaskRepository $repository, ProjectTaskService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index($id)
    {
        
        return $this->repository->findWhere(['project_id'=>$id]);
    }

    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function show($id, $taskId)
    {
        return $this->repository->findWhere(['project_id'=>$id,'id'=>$taskId]);
    }

    public function update(Request $request, $id, $taskId)
    {
        return $this->service->update($request->all(), $taskId);
    }

   public function destroy($id, $taskId)
   {
        try {
            $this->repository->find($taskId)->delete();
            return ['success'=>true, 'Tarefa deletada com sucesso!'];
        } catch (QueryException $e) {
            return ['error'=>true, 'Tarefa não pode ser apagada pois existe um ou mais projetos vinculados a ela.'];
        
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Tarefa não encontrada.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao excluir a tarefa.'];
        }
    }
}
