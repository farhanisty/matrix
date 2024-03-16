<?php

namespace Farhanisty\Matrix\Exceptions;

class InvalidMatrixSizeException extends \Exception
{
  protected $message = "size must be unsigned integer";
}
