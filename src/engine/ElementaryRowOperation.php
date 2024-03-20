<?php

namespace Farhanisty\Matrix\Engine;

interface ElementaryRowOperation extends MatrixResultOperation
{
  public function getDescription(): string;
}
