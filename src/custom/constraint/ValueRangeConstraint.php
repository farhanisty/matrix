<?php

namespace Farhanisty\Matrix\Custom\Constraint;

use Farhanisty\Matrix\Engine\AbstractMatrixConstraint;
use Farhanisty\Matrix\Engine\FailedMatrixConstraintResult;
use Farhanisty\Matrix\Engine\MatrixConstraintResult;

class ValueRangeConstraint extends AbstractMatrixConstraint
{
  public function __construct(
    private float $firstInterval,
    private float $lastInterval,
    private float $value
  ) {
  }

  public function check(): MatrixConstraintResult
  {
    if ($this->value < $this->firstInterval || $this->value > $this->lastInterval) {
      return new FailedMatrixConstraintResult($this->value . " out of interval [" . $this->firstInterval . ", " . $this->lastInterval . "]");
    }
    return parent::check();
  }
}
