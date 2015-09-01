<?php

namespace Syllashare\Service\Transformer;

use League\Fractal;

/**
 * This is the trait that implements the fractal 
 * transformer.  Should be attached to a Model subclass of 
 * Eloquent
 * @author Elliot Anderson <elliot@syllashare.com>
 */

trait TransformableTrait
{
	/**
	 * @var transformFormat
	 * This is the fractal defined transformation
	 */
	protected $transformFormat;

	/**
	 * This method will do the actual transformation
	 */
	public function transform()
	{

	}
}