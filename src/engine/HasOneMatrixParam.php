<?php

namespace Farhanisty\Matrix\Engine;

interface HasOneMatrixParam
{
  public function setMatrix(Matrix $matrix): void;

  public function getMatrix(): ?Matrix;
}
