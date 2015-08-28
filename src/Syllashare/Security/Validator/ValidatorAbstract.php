<?php

namespace Syllashare\Security\Validator;

use Input;
use Validator;

/**
 * This will handle all validation and sanitization of inputs from the server
 * It will normalize and resolve specified inputs
 * @author Elliot Anderson <elliot@booksmart.it>
 */
abstract class ValidatorAbstract 
{
	/**
	 * @var rawInput
	 * This is the raw input sent in the headers
	 */
	protected $rawInput;

	/**
	 * @var input
	 * This will be the modified input that will be returned
	 */
	protected $input;

	/**
	 * @var success
	 * This variable will tell you if the validation was a success, default false
	 */
	protected $success = false;

	/**
	 * @var required
	 * These are the required inputs in an array of input names
	 */
	protected $required = array();

	/**
	 * @var rules
	 * These are the laravel defined rules for validation
	 */
	protected $rules = array();


	/**
	 * @var error
	 */
	protected $error;

	/**
	 * instantiate the raw input from the server
	 */
	public function __construct()
	{
		$this->rawInput = Input::all();

		// to start, we want to populate the input variable with the raw input
		// we do this because unless they normalize it, we still return the original value
		$this->input = $this->rawInput;
	}

	/**
	 * magic get method will resolve a property from the input var
	 */
	public function __get($property)
	{
		return $this->input[$property];
	}

	/**
	 * This method will run the validation and normalization on the rawInput
	 * from the server. 
	 * @param 1 $array of input 'key' => 'value'
	 * @return array of modified data
	 */
	public function validate()
	{
		foreach ($this->required as $key) {

			// check to see if the required value is in the raw input
			if (!isset($this->rawInput[$key])) {
				// failed
				$this->success = false;

				$this->error = 'Input '.$key.' is required.';

				return $this;
			}
		}

		$this->success = true;

		$this->laravelValidate();

		return $this;
	}

	/**
	 * Normalizes the input to whatever function is set
	 * will update the $input variable with the modified data
	 * @param 1 -> key of data to be modified in the rawInput array
	 * @param 2 -> function of how to normalize the data (function MUST return value of normalized input) 
	 * @return null
	 */
	protected function normalize($key, $function)
	{
		if (!isset($this->input[$key])) {
			$this->input[$key] = $function();
		} else {
			// function should have a parameter of the key, and should return the value
			$this->input[$key] = $function($this->rawInput[$key]);
		}
	}

	/**
	 * getter for the input
	 * @return array of input 
	 */
	public function getInput()
	{
		return $this->input;
	}

	/**
	 * checks to see if the validator failed (will be false until successful validate() method called)
	 * @return true/false
	 */
	public function failed()
	{
		if (! $this->success) return true;

		return false;
	}

	/**
	 * sets the required inputs
	 * @param array of input keys that are required
	 * @return null
	 */
	public function setRequired($array)
	{
		$this->required = $array;
	}

	/**
	 * get an input value from rawInput
	 * @param key of input value 
	 * @return value
	 */
	public function getRawValue($key)
	{
		return $this->rawInput[$key];
	}

	/**
	 * get the error string
	 * @return string of error
	 */
	public function getError()
	{
		return $this->error;
	}	

	/**
	 * calls the laravel validation method
	 * @see Laravel docs for validation rules (4.2)
	 * @return null
	 */
	private function laravelValidate()
	{
		$rules = $this->rules;

		$input = $this->rawInput;

		$validator = Validator::make($input, $rules);

		if ($validator->fails()) {

			$this->success = false;
			$this->error = $validator->messages()->first();
		}
	}

	/**
	 * Makes an error on the validator
	 * Sets success to false
	 * @param Error String
	 */	
	public function throwError($string)
	{	
		$this->success = false;

		$this->error = $string;
	}


}