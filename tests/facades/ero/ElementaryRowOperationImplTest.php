<?php

namespace Farhanisty\Matrix\Facades\ERO;

use Farhanisty\Matrix\Custom\Operation\ERO\ScalarMultiplicationRowOperation;
use Farhanisty\Matrix\Custom\Operation\ERO\SwapRowOperation;
use Farhanisty\Matrix\Engine\Matrix;
use PHPUnit\Framework\TestCase;

class ElementaryRowOperationImplTest extends TestCase
{
  private ?ElementaryRowOperation $ero = null;
  private ?Matrix $matrix = null;

  public function setUp(): void
  {
    $this->matrix = new Matrix(3, 3, [[1, 2, 3], [3, 4, 5], [6, 7, 8]]);
    $ero = new ElementaryRowOperationImpl();

    $ero->setMatrix($this->matrix);

    $this->ero = $ero;
  }

  public function testGetActiveOperation()
  {
    $matrix = new Matrix(3, 3, [[1, 2, 3], [3, 4, 5], [6, 7, 8]]);
    $ero = new ElementaryRowOperationImpl();
    $ero->setMatrix($matrix);

    $ero->scalarMultiplication(2, 2);
    $ero->swapRow(1, 2);

    $this->assertInstanceOf(ScalarMultiplicationRowOperation::class, $ero->getActiveOperation());

    $ero->next();
    $this->assertInstanceOf(SwapRowOperation::class, $ero->getActiveOperation());
  }

  public function testLength()
  {
    $this->assertSame($this->ero->length(), 0);

    $this->ero->scalarMultiplication(2, 2);
    $this->assertSame($this->ero->length(), 1);

    $this->ero->swapRow(1, 2);
    $this->assertSame($this->ero->length(), 2);

    $this->ero->sumByMultiplesOfOtherRow(2, 1, 2);
    $this->assertSame($this->ero->length(), 3);
  }

  public function testNext()
  {
    $matrix = new Matrix(3, 3, [[1, 2, 3], [3, 4, 5], [6, 7, 8]]);
    $ero = new ElementaryRowOperationImpl();

    $ero->setMatrix($matrix);
    $this->assertSame($ero->getPosition(), null);

    $ero->scalarMultiplication(2, 2);
    $ero->swapRow(1, 2);

    $this->assertSame($ero->getPosition(), 1);

    $this->assertTrue($ero->next());
    $this->assertSame($ero->getPosition(), 2);

    $this->assertFalse($ero->next());
    $this->assertSame($ero->getPosition(), 2);

    $this->assertFalse($ero->next());
    $this->assertSame($ero->getPosition(), 2);
  }

  public function testPrev()
  {
    $matrix = new Matrix(3, 3, [[1, 2, 3], [3, 4, 5], [6, 7, 8]]);
    $ero = new ElementaryRowOperationImpl();

    $ero->setMatrix($matrix);

    $ero->scalarMultiplication(2, 2);
    $ero->scalarMultiplication(2, 2);
    $ero->swapRow(1, 2);

    $ero->next();
    $ero->next();
    $this->assertSame($ero->getPosition(), 3);

    $this->assertTrue($ero->prev());
    $this->assertSame($ero->getPosition(), 2);

    $this->assertTrue($ero->prev());
    $this->assertSame($ero->getPosition(), 1);

    $this->assertFalse($ero->prev());
    $this->assertSame($ero->getPosition(), 1);
  }

  public function testPosition()
  {
    $matrix = new Matrix(3, 3, [[1, 2, 3], [3, 4, 5], [6, 7, 8]]);
    $ero = new ElementaryRowOperationImpl();

    $ero->setMatrix($matrix);

    $ero->scalarMultiplication(2, 2);
    $ero->swapRow(1, 2);

    $this->assertSame($ero->getPosition(), 1);

    $ero->next();
    $this->assertSame($ero->getPosition(), 2);

    $ero->prev();
    $this->assertSame($ero->getPosition(), 1);

    $ero->prev();
    $this->assertSame($ero->getPosition(), 1);

    $ero->next();

    $ero->resetPosition();

    $this->assertSame($ero->getPosition(), 1);

    $ero->lastPosition();
    $this->assertSame($ero->getPosition(), 2);
  }

  public function testExecute()
  {
    $matrix = new Matrix(3, 3, [[1, 2, 3], [3, 4, 5], [6, 7, 8]]);
    $ero = new ElementaryRowOperationImpl();

    $ero->setMatrix($matrix);

    $ero->scalarMultiplication(2, 2);

    $ero->execute();

    $this->assertSame($matrix->getRow(2)->getValues(), [6.0, 8.0, 10.0]);

    $ero->execute();

    $this->assertSame($matrix->getRow(2)->getValues(), [12.0, 16.0, 20.0]);
  }

  public function testScalarMultiplication()
  {
    $matrix = new Matrix(3, 3, [[1, 2, 3], [3, 4, 5], [6, 7, 8]]);
    $ero = new ElementaryRowOperationImpl();
    $ero->setMatrix($matrix);

    $ero->scalarMultiplication(2, 2);

    $ero->execute();

    $this->assertSame($matrix->getRow(2)->getValues(), [6.0, 8.0, 10.0]);
  }

  public function testSwapRow()
  {
    $matrix = new Matrix(3, 3, [[1, 2, 3], [3, 4, 5], [6, 7, 8]]);
    $ero = new ElementaryRowOperationImpl();
    $ero->setMatrix($matrix);

    $ero->swapRow(1, 2);
    $ero->execute();

    $this->assertSame($matrix->getRow(1)->getValues(), [3, 4, 5]);
    $this->assertSame($matrix->getRow(2)->getValues(), [1, 2, 3]);
  }

  public function testSumByMultiplesOfOtherRow()
  {
    $matrix = new Matrix(3, 3, [[1, 2, 3], [3, 4, 5], [6, 7, 8]]);
    $ero = new ElementaryRowOperationImpl();
    $ero->setMatrix($matrix);

    $ero->sumByMultiplesOfOtherRow(1, 1, 2);
    $ero->execute();

    $this->assertSame($matrix->getRow(2)->getValues(), [4.0, 6.0, 8.0]);
  }

  public function testExecuteAll()
  {
    $matrix = new Matrix(3, 3, [[1, 2, 3], [3, 4, 5], [6, 7, 8]]);
    $ero = new ElementaryRowOperationImpl();
    $ero->setMatrix($matrix);

    $ero->swapRow(1, 2);
    $ero->swapRow(2, 1);

    $ero->executeAll();

    $ero->undo();
    $this->assertSame($matrix->getRow(1)->getValues(), [3, 4, 5]);

    $ero->undo();
    $this->assertSame($matrix->getRow(1)->getValues(), [1, 2, 3]);
  }
}
