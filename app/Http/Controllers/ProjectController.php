<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Services\ProjectService;
use CodeProject\Repositories\ProjectRepository;

class ProjectController extends Controller
{
    private $repository;
    private $service;

    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
    	
    	return $this->repository->with(['owner','client'])->all();
    }

    public function store(Request $request)
    {
    	return $this->service->create($request->all());
    }

    public function show($id)
    {
    	return $this->repository->find($id);
    }

    public function update(Request $request, $id)
    {
    	return $this->service->update($request->all(), $id);

    }

    public function destroy($id)
    {
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
}
