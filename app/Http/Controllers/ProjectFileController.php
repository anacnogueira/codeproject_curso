<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Requests;
use CodeProject\Services\ProjectFileService;
use CodeProject\Repositories\ProjectFileRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Exceptions\NoActiveAccessTokenException;


class ProjectFileController extends Controller
{
    private $repository;
    private $service;

    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index($id)
    {
        return $this->repository->findWhere(['project_id' =>$id]);
    }

    
    public function store(Request $request)
    {
    	$file = $request->file('file');

        if (!$file) {
            return $this->errorMsgm("O arquivo é obrigatório");
        }

        $extension = $file->getClientOriginalExtension();

        $data['file'] = $file;
        $data['extension'] = $extension;
        $data['name'] = $request->name;
        $data['project_id'] = $request->project_id;
        $data['description'] = $request->description;

        $this->service->create($data);        
    }    

    public function show($projectId, $id)
    {
        $this->repository->find($id);
    }

    public function showFile($projectId, $id)
    {
        $filePath = $this->service->getFilePath($id);
        $fileContent = file_get_contents($filePath);
        $file64 = base64_encode($fileContent);

        return [
            'file' => $file64,
            'size' => filesize($filePath),
            'name' => $this->service->getFileName($id),
            'mime_type' => $this->service->getMimeType($id);
        ];
    }

    public function update(Request $request, $projectId, $id)
    {
        try {
            return $this->service->update($request->all(), $id);
        
        } catch (ModelNotFoundException $e){
            return $this->errorMsgm('Projeto não encontrado.');
        } catch (NoActiveAccessTokenException $e) {
            return $this->errorMsgm('Usuário não está logado.');
        } catch (\Exception $e) {
            return $this->errorMsgm('Ocorreu um erro ao atualizar o projeto.');
        }
    }

    public function destroy($projectId, $id)
    {
        $this->service->delete($id);
        return ['error'=>false, 'Arquivo deletado com sucesso'];
    }

    private function errorMsgm($mensagem)
    {
        return [
            'error' => true,
            'message' => $mensagem
        ];
    }
}
