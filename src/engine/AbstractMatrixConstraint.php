<?php

namespace Farhanisty\Matrix\Engine;

use Farhanist\Matrix\Engine\MatrixConstraint;

abstract class AbstractMatrixConstraint implements MatrixConstraint
{
  protected ?MatrixConstraint $nextConstraint = null;

  public function setNext(MatrixConstraint $nextConstraint): MatrixConstraint
  {
    $this->nextConstraint = $nextConstraint;

    return $nextConstraint;
  }

  public function check(): bool
  {
    if($this->nextConstraint) {
      $this->nextConstraint->check();
    }

    return true;
  }
}
