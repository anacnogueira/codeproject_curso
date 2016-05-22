<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Services\ProjectService;
use CodeProject\Repositories\ProjectMembersRepository;


class ProjectMembersController extends Controller
{

    /**
     * @var ProjectMembersRepository
     */
    protected $repository;

    /**
     * @var ProjectMembersValidator
     */
    protected $validator;


    public function __construct(ProjectMembersRepository $repository, ProjectService $service)
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
        
        return $this->service->addMember($request->all());
    }

    public function show($id, $memberId)
    {
        
        return $this->service->isMember($id, $memberId);
    }

    public function destroy($id, $memberId)
    {

        return $this->service->removeMember($id, $memberId);
    }



    
}
