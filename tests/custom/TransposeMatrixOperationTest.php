<?php

namespace Farhanisty\Matrix\Custom\Operation;

use Farhanisty\Matrix\Custom\Operation\TransposeMatrixOperation;
use Farhanisty\Matrix\Engine\Matrix;
use PHPUnit\Framework\TestCase;

final class TransposeMatrixOperationTest extends TestCase
{
  private ?Matrix $matrix = null;
  private ?TransposeMatrixOperation $operation = null;

  public function setUp(): void
  {
    $this->matrix = new Matrix(3,2,[[1,2],[3,4],[5,6]]);
    $this->operation = new TransposeMatrixOperation($this->matrix);
  }

  public function testExecute()
  {
    $matrix = new Matrix(3,2,[[1,2],[3,4],[5,6]]);
    $operation = new TransposeMatrixOperation($this->matrix);

    $resultMatrix = $this->operation->execute();

    $this->assertSame($resultMatrix->getHeight(), 2);
    $this->assertSame($resultMatrix->getWidth(), 3);

    $this->assertTrue($resultMatrix->isEqual(new Matrix(2,3,[[1,3,5],[2,4,6]])));
  }
}
