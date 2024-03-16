<?php

namespace Farhanisty\Matrix\Custom\Operation;

use Farhanisty\Matrix\Engine\Matrix;
use Farhanisty\Matrix\Engine\MatrixResultOperation;

class TransposeMatrixOperation implements MatrixResultOperation
{
  public function __construct(
    private Matrix $matrix
  ) {}

  public function execute(): Matrix
  {
    return new Matrix($this->matrix->getWidth(), $this->matrix->getHeight(), $this->getValueResult());
  }

  public function executeTo(Matrix $matrix): void
  {
    $matrix->initialize($this->matrix->getWidth(), $this->matrix->getHeight(), $this->getValueResult());
  }

  public function getValueResult(): array
  {
    $tmp = [];

    foreach($this->matrix->getValues() as $key => $value) {
      foreach($value as $k => $v) {
        $tmp[$k][$key] = $v;
      }
    }

    return $tmp;
  }
}
