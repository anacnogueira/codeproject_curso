<?php
namespace CodeProject\Validators;

use \Prettus\Validator\LaravelValidator;

class UserValidator extends LaravelValidator
{
	protected $rules = [
		'name' => 'required|max:255',		
	];
}