<?php

namespace Farhanisty\Matrix\Engine;

use Farhanisty\Matrix\Engine\Matrix;
use Farhanisty\Matrix\Engine\MatrixConstraintResult;

interface MatrixConstraint
{
  public function setNext(MatrixConstraint $nextConstraint): MatrixConstraint;

  public function check(): MatrixConstraintResult;
}
