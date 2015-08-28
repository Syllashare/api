<?php

namespace Syllashare\Component\Date\Day\Model;

use Eloquent;

class Day extends Eloquent
{
	public function year()
	{
		return $this->belongsTo('Syllashare\Component\Date\Year\Model\Year');
	}
}