<?php

namespace Farhanisty\Matrix\Custom\Constraint;

use Farhanisty\Matrix\Engine\AbstractMatrixConstraint;
use Farhanisty\Matrix\Engine\FailedMatrixConstraintResult;
use Farhanisty\Matrix\Engine\MatrixConstraintResult;

class MustBeNotSameValueConstraint extends AbstractMatrixConstraint
{
  public function __construct(
    private $firstValue,
    private $secondValue
  ) {
  }

  public function check(): MatrixConstraintResult
  {
    if ($this->firstValue === $this->secondValue) {
      return new FailedMatrixConstraintResult("Both value must be not same");
    }

    return parent::check();
  }
}
