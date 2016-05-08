<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Services\ClientService;
use CodeProject\Repositories\ClientRepository;

class ClientController extends Controller
{
    private $repository;
    private $service;

    public function __construct(ClientRepository $repository, ClientService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
    	
    	return $this->repository->all();
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
