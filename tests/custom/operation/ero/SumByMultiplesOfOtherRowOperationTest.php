<?php

namespace Farhanisty\Matrix\Custom\Operation\ERO;

use Farhanisty\Matrix\Engine\Matrix;
use PHPUnit\Framework\TestCase;

class SumByMultiplesOfOtherRowOperationTest extends TestCase
{
  public function testExecute()
  {
    $matrix = new Matrix(2, 2, [[6, 3], [-1, 4]]);

    $operation = new SumByMultiplesOfOtherRowOperation(2, 2, 1, $matrix);
    $operation->executeTo($matrix);

    $this->assertSame([4.0, 11.0], $matrix->getRow(1)->getValues());

    $operation = new SumByMultiplesOfOtherRowOperation(-1, 1, 2, $matrix);
    $operation->executeTo($matrix);

    $this->assertSame([-5.0, -7.0], $matrix->getRow(2)->getValues());
  }
}
