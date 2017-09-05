<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Requests;
use CodeProject\Repositories\ClientRepository;
use CodeProject\Services\ClientService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class ClientController extends Controller
{
    private $repository;
    private $service;

    public function __construct(ClientRepository $repository, ClientService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index(Request $request)
    {
    	
    	// try{
     //        $limit = $request->query->get('limit', 15);
     //        return $this->repository->paginate($limit);
     //    } catch(\Exception $e) {
     //        return$this->errorMsgm('Ocorreu um erro ao listar os clientes.');
     //    }

        return $this->repository->all();
    }

    public function store(Request $request)
    {
    	try{
            return $this->service->create($reques->all());
        } catch (ValidatorException $e) {
            return Response::json([
                'error' => true,
                'message' => $e->getMessageBag()
            ], 400);
        }
 
    }

    public function show($id)
    {
    	try {
            return $this->repository->find($id);
        } catch (\Exception $e) {
            return $this->erorMsgm('Ocorreu um erro ao exibir o cliente.');
        }
        return $this->repository->find($id);
    }

    public function update(Request $request, $id)
    {
    	try {
            return $this->service->update($request->all(), $id);
        } catch (ModelNotFoundException $e) {
            return Response::json([
                'error' => true,
                'message' => $e->getMessageBag()
            ], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $this->repository->skipPresenter()->find($id)->delete();
            return [
                'success'=>true, 
                'message' => 'Cliente deletado com sucesso!'
            ];
        } catch (QueryException $e) {
            return [
                'error'=>true, 
                'message' => 'Cliente não pode ser apagado pois existe um ou mais projetos vinculados a ele.'
            ];
        
        } catch (ModelNotFoundException $e) {
            return [
                'error'=>true, 
                'message' => 'Cliente não encontrado.'
            ];
        } catch (\Exception $e) {
            return [
                'error'=>true, 
                'message' => 'Ocorreu algum erro ao excluir o cliente.'
            ];
        }    	
    }

    private function errorMsgm($mensagem)
    {
        return [
            'error' => true,
            'message' => $mensagem
        ];
    }
}
