<?php

namespace Syllashare\Security\Error;

class Error
{

  protected $errorMsg;

  /**
  * @param Optional String error message
  * If you want to take the shortcut, you can create this object with a message, then return
  * it shortly thereafter
  */
  public function __construct($string)
  {
    $this->errorMsg = $string;
  }

  public function __toString()
  {
    return json_encode(array('error' => $this->errorMsg));
  }

  public function setMessage($string) {
    $this->errorMsg = $string;
  }

}
