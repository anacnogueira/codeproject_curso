<?php

namespace CodeProject\Http\Controllers;

use Storage;
use File;
use Illuminate\Http\Request;
use CodeProject\Services\ProjectService;
use CodeProject\Repositories\ProjectRepository;

class ProjectFileController extends Controller
{
    private $repository;
    private $service;

    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    
    public function store(Request $request)
    {
    	$file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        Storage::put($request->name.'.'.$extension, File::get($file));
    }    
}
