<?php 

namespace CodeProject\Http\Middleware;

use CodeProject\Services\ProjectService;



class CheckProjectPermission
{
	
	protected $service;

	function __construct(ProjectService $service)
	{
		$this->service = $service;
	}

	/**
	* Handle an incoming request.
	* @param \Illuminate\Http\Rquest $request
	* @param \Closure $next
	* @return mixed
	*/
	public function handle($requets, Closure $next)
	{
		$projectId = $request->route('id') ? $request->route('id') : $request->route('project');

		if ($this->service->checkProjectPermissions($projectId) == false) {
		 	return ['error' => 'You haven\'t permission to access project '];
		}

		return $next($request);
	}
}