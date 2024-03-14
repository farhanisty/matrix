<?php

namespace Farhanisty\Matrix\Engine;

use Farhanist\Matrix\Engine\Matrix;

interface MatrixResultOperation
{
  public function execute(): Matrix;
  public function executeTo(Matrix $matrix): void;
  public function getValueResult(): array;
}
