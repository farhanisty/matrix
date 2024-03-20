<?php

namespace Farhanisty\Matrix\Custom\Operation\ERO;

use Farhanisty\Matrix\Engine\Matrix;
use PHPUnit\Framework\TestCase;

class ScalarMultiplicationRowOperationTest extends TestCase
{
  public function testExecute()
  {
    $matrix = new Matrix(3, 4, [[1, 2, 3, 4], [5, 6, 7, 7], [2, 2, 2, 2]]);

    $operation = new ScalarMultiplicationRowOperation(5, 3, $matrix);
    $operation->executeTo($matrix);

    $this->assertSame([10.0, 10.0, 10.0, 10.0], $matrix->getRow(3)->getValues());
  }

  public function testScalarIsZero()
  {
    $matrix = new Matrix(3, 4, [[1, 2, 3, 4], [5, 6, 7, 7], [2, 2, 2, 2]]);
    $operation = new ScalarMultiplicationRowOperation(0, 3, $matrix);

    $constraintResult = $operation->getConstraint()->check();

    $this->assertFalse($constraintResult->getStatus());
  }
}
