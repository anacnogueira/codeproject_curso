<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Services\ProjectTaskService;
use CodeProject\Repositories\ProjectTaskRepository;


class ProjectTaskController extends Controller
{

    
    protected $repository;
    protected $service;
  


   public function __construct(ProjectTaskRepository $repository, ProjectTaskService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index($id)
    {
        
        return $this->repository->findWhere(['project_id'=>$id]);
    }

    public function store(Request $request, $id)
    {
        $data = $request->all();
        $data['project_id'] = $id;

        return $this->service->create($data);
    }

    public function show($id, $taskId)
    {
        return $this->repository->find($taskId);
    }

    public function update(Request $request, $id, $taskId)
    {
        $data = $request->all();
        $data['project_id'] = $id;
        return $this->service->update($request->all(), $taskId);
    }

    public function destroy($id, $taskId)
    {
        $this->service->delete($taskId);     
    }
}