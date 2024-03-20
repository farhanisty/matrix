<?php

namespace Farhanisty\Matrix\Custom\Operation\ERO;

use Farhanisty\Matrix\Custom\Constraint\MustBeNotSameValueConstraint;
use Farhanisty\Matrix\Custom\Constraint\ValueRangeConstraint;
use Farhanisty\Matrix\Engine\ElementaryRowOperation;
use Farhanisty\Matrix\Engine\HasConstraint;
use Farhanisty\Matrix\Engine\Matrix;
use Farhanisty\Matrix\Engine\MatrixConstraint;

class SumByMultiplesOfOtherRowOperation implements ElementaryRowOperation, HasConstraint
{
  public function __construct(
    private float $scalar,
    private int $otherRow,
    private int $mainRow,
    private Matrix $matrix
  ) {
  }

  public function getConstraint(): MatrixConstraint
  {
    $constraint = new MustBeNotSameValueConstraint(0, $this->scalar);
    $constraint->setNext(new ValueRangeConstraint(1, $this->matrix->getheight(), $this->otherRow));
    $constraint->setNext(new ValueRangeConstraint(1, $this->matrix->getheight(), $this->mainRow));

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
    $values = $this->matrix->getValues();
    $result = [];

    $otherRow = $this->matrix->getRow($this->otherRow);
    $mainRowValues = $this->matrix->getRow($this->mainRow)->getValues();

    foreach ($otherRow->getValues() as $key => $value) {
      $result[] = ($value * $this->scalar) + $mainRowValues[$key];
    }

    $values[$this->mainRow - 1] = $result;

    return $values;
  }

  public function getDescription(): string
  {
    return $this->scalar . "B" . $this->otherRow . " + B" . $this->mainRow;
  }

  public function undo(Matrix $matrix): void
  {
    $mainRowValues = $matrix->getRow($this->mainRow)->getValues();
    $otherRow = $matrix->getRow($this->otherRow);

    $result = [];

    foreach ($otherRow->getValues() as $key => $value) {
      $result[] = $mainRowValues[$key] - ($value * $this->scalar);
    }

    $matrix->replaceRow($this->mainRow, $result);
  }
}
