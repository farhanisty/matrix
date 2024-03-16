<?php

namespace Farhanisty\Matrix\Engine;

use Farhanisty\Matrix\Engine\MatrixConstraintResult;

class SuccessMatrixConstraintResult implements MatrixConstraintResult
{
  public function getStatus(): bool
  {
    return true;
  }
}
