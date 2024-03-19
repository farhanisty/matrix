<?php

namespace Farhanisty\Matrix\Custom\Constraint;

use Farhanisty\Matrix\Engine\AbstractMatrixConstraint;
use Farhanisty\Matrix\Engine\FailedMatrixConstraintResult;
use Farhanisty\Matrix\Engine\MatrixConstraintResult;

class MustBeSameValueConstraint extends AbstractMatrixConstraint
{
  public function __construct(
    private $firstValue,
    private $secondValue,
    protected string $message = "Value is not same"
  ) {
  }

  public function check(): MatrixConstraintResult
  {
    if ($this->firstValue != $this->secondValue) {
      return new FailedMatrixConstraintResult($this->message);
    }

    return parent::check();
  }
}
