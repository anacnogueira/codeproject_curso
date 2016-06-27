<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Services\ProjectNoteService;
use CodeProject\Repositories\ProjectNoteRepository;

class ProjectNoteController extends Controller
{
    private $repository;
    private $service;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service)
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

    public function show($id, $noteId)
    {
        return $this->repository->findWhere(['project_id'=>$id,'id'=>$noteId]);
    }

    public function update(Request $request, $id, $noteId)
    {
    	return $this->service->update($request->all(), $noteId);
    }

     public function destroy($id, $noteId)
    {
    	try {
            $this->repository->find($noteId)->delete();
            return ['success'=>true, 'Nota deletada com sucesso!'];
        } catch (QueryException $e) {
            return ['error'=>true, 'Nota não pode ser apagada pois existe um ou mais projetos vinculados a ela.'];
        
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Nota não encontrada.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao excluir a nota.'];
        }
    }
}
