<?php

namespace Farhanisty\Matrix\Custom\Operation;

use Farhanisty\Matrix\Custom\Constraint\MustBeSameValueConstraint;
use Farhanisty\Matrix\Engine\HasConstraint;
use Farhanisty\Matrix\Engine\Matrix;
use Farhanisty\Matrix\Engine\MatrixConstraint;
use Farhanisty\Matrix\Engine\MatrixResultOperation;

class MatrixMultiplicationOperation implements MatrixResultOperation, HasConstraint
{
  public function __construct(
    private Matrix $firstMatrix,
    private Matrix $secondMatrix
  ) {}

  public function getConstraint(): MatrixConstraint
  {
    return new MustBeSameValueConstraint($this->firstMatrix->getWidth(), $this->secondMatrix->getHeight());
  }

  public function execute(): Matrix
  {
    return new Matrix($this->firstMatrix->getHeight(), $this->secondMatrix->getWidth(), $this->getValueResult());
  }

  public function executeTo(Matrix $matrix): void
  {
    $matrix->initialize($this->firstMatrix->getHeight(), $this->secondMatrix->getWidth(), $this->getValueResult());
  }

  public function getValueResult(): array
  {
    $result = [];

    foreach($this->firstMatrix->getAllRows() as $rowIndex => $firstMatrixRow) {
      foreach($this->secondMatrix->getAllCols() as $colIndex => $secondMatrixCol) {
        $tmp = 0;
        for($i = 1;$i <= $this->firstMatrix->getWidth();$i++) {
          $tmp += $firstMatrixRow->getValueByPosition($i) * $secondMatrixCol->getValueByPosition($i);
        }

        $result[$rowIndex][$colIndex] = $tmp;
      }
    }

    return $result;
  }
}
