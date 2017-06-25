<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Services\ProjectService;
use CodeProject\Repositories\ProjectMemberRepository;

use CodeProject\Http\Requests;
use CodeProject\Http\Controllers\Controller;


class ProjectMemberController extends Controller
{

    private $repository;
    private $service;


    public function __construct(ProjectMemberRepository $repository, ProjectService $service)
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

    public function show($id, $memberId)
    {
        
        return $this->service->find($memberId);
    }

    public function destroy($id, $memberId)
    {

        return $this->service->delete($id, $memberId);
    }    
}