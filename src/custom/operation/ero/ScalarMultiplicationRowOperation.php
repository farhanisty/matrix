<?php

namespace Farhanisty\Matrix\Custom\Operation\ERO;

use Farhanisty\Matrix\Custom\Constraint\MustBeNotSameValueConstraint;
use Farhanisty\Matrix\Custom\Constraint\ValueRangeConstraint;
use Farhanisty\Matrix\Engine\HasConstraint;
use Farhanisty\Matrix\Engine\Matrix;
use Farhanisty\Matrix\Engine\MatrixConstraint;
use Farhanisty\Matrix\Engine\MatrixResultOperation;

class ScalarMultiplicationRowOperation implements MatrixResultOperation, HasConstraint
{
  public function __construct(
    private int $scalar,
    private int $row,
    private Matrix $matrix
  ) {
  }

  public function getConstraint(): MatrixConstraint
  {
    $constraint = new MustBeNotSameValueConstraint(0, $this->scalar);
    $constraint->setNext(new ValueRangeConstraint(1, $this->matrix->getHeight(), $this->row));

    return $constraint;
  }

  public function execute(): Matrix
  {
    return new Matrix($this->matrix->getHeight(), $this->matrix->getWidth(), $this->getValueResult());
  }

  public function executeTo(Matrix $matrix): void
  {
    $matrix->initialize($this->matrix->getHeight(), $this->matrix->getWidth(), $this->getValueResult());
  }

  public function getValueResult(): array
  {
    $row = $this->matrix->getRow($this->row);
    $values = $this->matrix->getValues();

    $valueTemp = [];

    foreach ($row->getValues() as $value) {
      $valueTemp[] = $this->scalar * $value;
    }

    $values[$this->row - 1] = $valueTemp;

    return $values;
  }
}
