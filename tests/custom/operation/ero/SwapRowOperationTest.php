<?php

namespace Farhanisty\Matrix\Custom\Operation\ERO;

use Farhanisty\Matrix\Engine\Matrix;
use PHPUnit\Framework\TestCase;

class SwapRowOperationTest extends TestCase
{
  public function testSwapRow()
  {
    $matrix = new Matrix(4, 3, [[1, 2, 3], [4, 5, 6], [7, 8, 9], [10, 11, 12]]);

    $operation = new SwapRowOperation(1, 2, $matrix);
    $operation->executeTo($matrix);

    $this->assertSame([4, 5, 6], $matrix->getRow(1)->getValues());
    $this->assertSame([1, 2, 3], $matrix->getRow(2)->getValues());

    $operation = new SwapRowOperation(2, 4, $matrix);
    $operation->executeTo($matrix);

    $this->assertSame([1, 2, 3], $matrix->getRow(4)->getValues());
    $this->assertSame([10, 11, 12], $matrix->getRow(2)->getValues());
  }

  public function testOutOfRangeRow()
  {
    $matrix = new Matrix(4, 3, [[1, 2, 3], [4, 5, 6], [7, 8, 9], [10, 11, 12]]);

    $operation = new SwapRowOperation(5, 2, $matrix);
    $constraintResult = $operation->getConstraint()->check();

    $this->assertFalse($constraintResult->getStatus());
  }
}
