<?php

namespace Farhanisty\Matrix\Engine;

use Farhanist\Matrix\Engine\Matrix;

interface MatrixConstraint
{
  public function setNext(MatrixConstraint $nextConstraint): MatrixConstraint;

  public function check(): bool;
}
