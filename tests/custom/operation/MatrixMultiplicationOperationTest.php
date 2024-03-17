<?php

namespace Farhanisty\Matrix\Custom\Operation;

use Farhanisty\Matrix\Custom\Operation\MatrixMultiplicationOperation;
use Farhanisty\Matrix\Engine\Matrix;
use PHPUnit\Framework\TestCase;

final class MatrixMultiplicationOperationTest extends TestCase
{
  public function testExecute()
  {
    $matrix1 = new Matrix(2, 2, [[2, 3], [3, 4]]);
    $matrix2 = new Matrix(2, 3, [[2, 3, 4], [3, 4, 5]]);

    $operation = new MatrixMultiplicationOperation($matrix1, $matrix2);

    if ($operation->getConstraint()->check()->getStatus()) {
      $result = $operation->execute();

      $this->assertSame($result->getHeight(), 2);
      $this->assertSame($result->getWidth(), 3);

      $this->assertSame($result->getValues(), [[13, 18, 23], [18, 25, 32]]);
    }
  }

  public function testDifferentSize()
  {
    $matrix1 = new Matrix(2, 3, [[2, 3, 4], [3, 4, 5]]);
    $matrix2 = new Matrix(2, 3, [[2, 3, 4], [3, 4, 5]]);

    $operation = new MatrixMultiplicationOperation($matrix1, $matrix2);

    $this->assertFalse($operation->getConstraint()->check()->getStatus());
  }
}
