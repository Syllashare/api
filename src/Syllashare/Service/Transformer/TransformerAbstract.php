<?php

namespace Syllashare\Service\Transformer;

use Eloquent;

/**
 * This abstract class will allow for easy data formatting for eloquent models
 * This makes it easy for the api
 */
abstract class TransformerAbstract
{
	/**
	 * @var model holds the object to be transformed
	 */
	protected $model;

	/**
	 * @var rules 
	 * ARRAY 
	 */
	protected $rules = array();

	/**
	 * Constructor requires an instance of an Eloquent model (child)
	 * Sets the model variable to the @param 
	 */
	public function __construct(Eloquent $model)
	{
		$this->model = $model;
	}

	/**
	 * this method will transform the data as set per the rules and will return the data in json
	 * @return json string
	 */ 

	public function transform() 
	{
		
	}

}