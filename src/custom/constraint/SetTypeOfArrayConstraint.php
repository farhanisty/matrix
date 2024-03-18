<?php

namespace Farhanisty\Matrix\Custom\Constraint;

use Farhanisty\Matrix\Engine\AbstractMatrixConstraint;
use Farhanisty\Matrix\Engine\FailedMatrixConstraintResult;
use Farhanisty\Matrix\Engine\MatrixConstraintResult;

class SetTypeOfArrayConstraint extends AbstractMatrixConstraint
{
  public function __construct(
    private array $array,
    private string $type
  ) {
  }

  public function check(): MatrixConstraintResult
  {
    foreach ($this->array as $value) {
      if (gettype($value) != $this->type) {
        return new FailedMatrixConstraintResult("This array contains value that not " . $this->type);
      }
    }

    return parent::check();
  }
}
