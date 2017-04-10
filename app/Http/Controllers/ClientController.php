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
    	
    	try{
            $limit = $request->query->get('limit', 15);
            return $this->repository->paginate($limit);
        } catch(\Exception $e) {
            return$this->errorMsgm('Ocorreu um erro ao listar os clientes.');
        }
        //return $this->repository->all();
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
            return ['success'=>true, 'Cliente deletado com sucesso!'];
        } catch (QueryException $e) {
            return ['error'=>true, 'Cliente não pode ser apagado pois existe um ou mais projetos vinculados a ele.'];
        
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Cliente não encontrado.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao excluir o cliente.'];
        }

    	
    }
}
