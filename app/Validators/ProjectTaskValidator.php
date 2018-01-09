<?php

namespace CodeProject\Validators;

use \Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator {

    protected $rules = [
    	'name' => 'required',
		'start_date' => 'required|date',
		'due_date' => 'required|date',
		'status' => 'required',
   ];

}