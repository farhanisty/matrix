<?php

namespace Farhanisty\Matrix\Custom\Visualizer;

use Farhanisty\Matrix\Engine\MatrixVisualizer;
use Farhanisty\Matrix\Engine\Matrix;

class BasicMatrixVisualizer implements MatrixVisualizer
{
  public function visualize(Matrix $matrix): void
  {
    foreach($matrix->getAllRows() as $row) {
      foreach($row->getValues() as $value) {
        echo $value . "  ";
      }

      echo "\n";
    }
  }

  public function visualizeMany(array $matrixes): void
  {
    foreach($matrixes as $matrix) {
      $this->visualize($matrix);
    }
  }
}
