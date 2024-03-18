<?php

namespace Farhanisty\Matrix\Engine;

use Farhanisty\Matrix\Engine\MatrixConstraint;
use Farhanisty\Matrix\Engine\MatrixConstraintResult;
use Farhanisty\Matrix\Engine\SuccessMatrixConstraintResult;

abstract class AbstractMatrixConstraint implements MatrixConstraint
{
  protected ?MatrixConstraint $nextConstraint = null;

  public function setNext(MatrixConstraint $nextConstraint): MatrixConstraint
  {
    $this->nextConstraint = $nextConstraint;

    return $nextConstraint;
  }

  public function check(): MatrixConstraintResult
  {
    if ($this->nextConstraint) {
      return $this->nextConstraint->check();
    }

    return new SuccessMatrixConstraintResult();
  }
}
