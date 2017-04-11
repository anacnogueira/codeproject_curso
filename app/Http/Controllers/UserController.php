<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\UserRepository;

use Illuminate\Http\Request;

use CodeProject\Http\Requests;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class UserController extends Controller
{

	private $repository;
	/**
	 * Class Constructor
	 */
	public function __construct(UserRepository $repository)
	{
		$this->repository = $repository;
	}  


    public function authenticated()
    {
    	$userId = Authorizer::getResourceOwnerId();

    	return $this->repository->find($userId);
    }
}
