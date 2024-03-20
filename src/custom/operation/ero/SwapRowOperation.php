<?php

namespace Farhanisty\Matrix\Custom\Operation\ERO;

use Farhanisty\Matrix\Custom\Constraint\ValueRangeConstraint;
use Farhanisty\Matrix\Engine\ElementaryRowOperation;
use Farhanisty\Matrix\Engine\HasConstraint;
use Farhanisty\Matrix\Engine\Matrix;
use Farhanisty\Matrix\Engine\MatrixConstraint;

class SwapRowOperation implements ElementaryRowOperation, HasConstraint
{
  public function __construct(
    private int $firstRow,
    private int $secondRow,
    private Matrix $matrix
  ) {
  }

  public function getConstraint(): MatrixConstraint
  {
    $constraint = new ValueRangeConstraint(1, $this->matrix->getHeight(), $this->firstRow);
    $constraint->setNext(new ValueRangeConstraint(1, $this->matrix->getHeight(), $this->secondRow));

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
    $firstRow = $this->matrix->getRow($this->firstRow)->getValues();
    $secondRow = $this->matrix->getRow($this->secondRow)->getValues();

    $result = $this->matrix->getValues();

    $result[$this->firstRow - 1] = $secondRow;
    $result[$this->secondRow - 1] = $firstRow;

    return $result;
  }

  public function getDescription(): string
  {
    return "B" . $this->firstRow . " <=> " . "B" . $this->secondRow;
  }

  public function undo(Matrix $matrix): void
  {
    $this->executeTo($matrix);
  }
}
