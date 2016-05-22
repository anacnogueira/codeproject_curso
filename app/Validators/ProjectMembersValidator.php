<?php

namespace CodeProject\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProjectMembersValidator extends LaravelValidator {

    protected $rules = [
		'project_id' => 'required|integer',
		'user_id' => 'required|integer',
		
	];

}