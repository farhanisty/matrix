<?php

namespace Farhanisty\Matrix\Engine;

use Farhanisty\Matrix\Engine\Matrix;
use Farhanisty\Matrix\Engine\RowMatrix;
use Farhanisty\Matrix\Exceptions;
use PHPUnit\Framework\TestCase;

final class MatrixTest extends TestCase
{
  private ?Matrix $matrix = null;

  public function setUp(): void
  {
    $this->matrix = new Matrix(2,3,[[1,2,3], [3,4,5]]);
  }

  public function testValidConstructor()
  {
    $matrix = new Matrix(2,3,[[1,2,3], [3,4,5]]);

    $this->assertSame($matrix->getHeight(), 2);
    $this->assertSame($matrix->getWidth(), 3);
    $this->assertSame($matrix->getValues(), [[1,2,3], [3,4,5]]);
  }

  public function testInvalidSizeConstructor()
  {
    $this->expectException(Exceptions\InvalidMatrixSizeException::class);

    new Matrix(0, -2, [[],[]]);
  }

  public function testInvalidHeightValueConstructor()
  {
    $this->expectException(Exceptions\InvalidMatrixInitializationException::class);

    new Matrix(4, 2, [[1,2],[2,3],[3,5]]);
  }

  public function testInvalidWidthValueConstructor()
  {
    $this->expectException(Exceptions\InvalidMatrixInitializationException::class);

    new Matrix(4, 2, [[1,2,4],[2,3,6],[3,5,7],[4,5,8]]);
  }

  public function testGetByPosition()
  {
    $this->assertSame($this->matrix->getByPosition(1,1), 1);
    $this->assertSame($this->matrix->getByPosition(1,2), 2);
    $this->assertSame($this->matrix->getByPosition(2,1), 3);
    $this->assertSame($this->matrix->getByPosition(2,2), 4);

    $this->expectException(Exceptions\OutOfRangeException::class);

    $this->matrix->getByPosition(2,4);
  }

  public function testGetRow()
  {
    $row = $this->matrix->getRow(1);

    $this->assertInstanceOf(RowMatrix::class, $row);

    $this->assertSame($this->matrix->getValues()[0], $row->getValues());

    $this->expectException(Exceptions\OutOfRangeException::class);

    $this->matrix->getRow(4);
  }

  public function testGetCol()
  {
    $col = $this->matrix->getCol(1);

    $this->assertInstanceOf(ColMatrix::class, $col);
    $this->assertSame($col->getValues(), [1,3]);

    $this->expectException(Exceptions\OutOfRangeException::class);

    $this->matrix->getCol(5);
  }

  public function testGetAllCols()
  {
    $cols = $this->matrix->getAllCols();

    $this->assertSame(count($cols), 3);

    foreach($cols as $col) {
      $this->assertInstanceOf(ColMatrix::class, $col);
    }
  }

  public function testGetAllRows()
  {
    $rows = $this->matrix->getAllRows();

    $this->assertSame(count($rows), 2);

    foreach($rows as $row) {
      $this->assertInstanceOf(RowMatrix::class, $row);
    }
  }

  public function testIsEqual()
  {
    $matrix1 = new Matrix(2,2,[[2,3], [3,4]]);
    $matrix2 = new Matrix(2,2,[[2,3], [3,4]]);
    $matrix3 = new Matrix(3,2,[[1,2],[3,4],[5,6]]);

    $this->assertTrue($matrix1->isEqual($matrix2));
    $this->assertFalse($matrix1->isEqual($matrix3));
  }

  public function testHeightAndWidth()
  {
    $this->assertSame($this->matrix->getHeight(), 2);
    $this->assertSame($this->matrix->getWidth(), 3);
  }
}
