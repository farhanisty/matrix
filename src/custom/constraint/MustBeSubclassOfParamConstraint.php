<?php

namespace Farhanisty\Matrix\Custom\Constraint;

use Farhanisty\Matrix\Engine\AbstractMatrixConstraint;
use Farhanisty\Matrix\Engine\FailedMatrixConstraintResult;
use Farhanisty\Matrix\Engine\MatrixConstraintResult;

class MustBeSubclassOfParamConstraint extends AbstractMatrixConstraint
{
  public function __construct(
    private $class,
    private string $parent
  ) {
  }

  public function check(): MatrixConstraintResult
  {
    $classNamespace = get_class($this->class);
    if (!is_subclass_of(get_class($this->class), $this->parent)) {
      return new FailedMatrixConstraintResult($classNamespace . " is not inherit from " . $this->parent);
    }

    return parent::check();
  }
}
