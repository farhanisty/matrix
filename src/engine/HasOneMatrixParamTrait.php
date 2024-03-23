<?php

namespace Farhanisty\Matrix\Engine;

trait HasOneMatrixParamTrait
{
  protected ?Matrix $matrix = null;

  public function setMatrix(Matrix $matrix): void
  {
    $this->matrix = $matrix;
  }

  public function getMatrix(): ?Matrix
  {
    return $this->matrix;
  }
}
