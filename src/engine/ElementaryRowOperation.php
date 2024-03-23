<?php

namespace Farhanisty\Matrix\Engine;

abstract class ElementaryRowOperation implements MatrixResultOperation, HasOneMatrixParam
{
  use HasOneMatrixParamTrait;

  abstract public function getDescription(): string;
  abstract public function undo(Matrix $matrix): void;
}
