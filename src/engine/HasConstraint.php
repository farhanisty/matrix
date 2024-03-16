<?php

namespace Farhanisty\Matrix\Engine;

interface HasConstraint
{
  public function getConstraint(): MatrixConstraint;
}
