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

    public function store(Request $request, $id)
    {
    	$data = $request->all();
        $data['project_id'] = $id;
        return $this->service->create($data);
    }

    public function show($id, $noteId)
    {
        $result = $this->repository->findWhere(['project_id'=>$id,'id'=>$noteId]);
        if(isset($result['data']) && count($result['data']) == 1){
            $result = [
                'data' => $result['data'][0]
            ];
        }

        return $result;
    }

    public function update(Request $request, $id, $idNote)
    {
    	$data = $request->all();
        $data['project_id'] = $id;
        return $this->service->update($data, $idNote);
    }

     public function destroy($id, $idNote)
    {
    	try {
            if ($this->repository->skipPresenter()->find($noteId)->delete()){
            }    
            return ['success'=>true, 'message' => 'Nota deletada com sucesso!'];
        } catch (QueryException $e) {
            return ['error'=>true, 'message' => 'Nota não pode ser apagada pois existe um ou mais projetos vinculados a ela.'];
        
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'message' =>'Nota não encontrada.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'message' =>'Ocorreu algum erro ao excluir a nota.'];
        }
    }
}
