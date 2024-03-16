<?php

namespace Farhanisty\Matrix\Engine;

interface MatrixVisualizer
{
  public function visualize(Matrix $matrix): void;
  public function visualizeMany(array $matrixes): void;
}
