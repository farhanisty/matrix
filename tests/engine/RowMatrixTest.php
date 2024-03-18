<?php

namespace Farhanisty\Matrix\Engine;

use PHPUnit\Framework\TestCase;
use Farhanisty\Matrix\Engine\RowMatrix;
use Farhanisty\Matrix\Exceptions;

final class RowMatrixTest extends TestCase
{
  private ?RowMatrix $row = null;

  public function setUp(): void
  {
    $this->row = new RowMatrix([2, 3, 4, 5]);
  }

  public function testGetValues()
  {
    $this->assertSame($this->row->getValues(), [2, 3, 4, 5]);
  }

  public function testgetValueByPosition()
  {
    $this->assertSame($this->row->getValueByPosition(1), 2);
    $this->assertSame($this->row->getValueByPosition(2), 3);
    $this->assertSame($this->row->getValueByPosition(3), 4);
    $this->assertSame($this->row->getValueByPosition(4), 5);

    $this->expectException(Exceptions\OutOfRangeException::class);

    $this->row->getValueByPosition(5);
  }

  public function testLength()
  {
    $this->assertSame(4, $this->row->length());
  }

  public function testIsSameValues()
  {
    $row = new RowMatrix([2, 2, 2, 2, 2]);
    $this->assertTrue($row->isSameValues());
    $this->assertFalse($this->row->isSameValues());
  }

  public function testIsContain()
  {
    $this->assertTrue($this->row->isContain(2));
    $this->assertTrue($this->row->isContain(5));
    $this->assertFalse($this->row->isContain(10));
  }

  public function testMultiplyValues()
  {
    $row = new RowMatrix([2, 3, 5]);
    $this->assertSame($row->multiplyValues(), 30);
  }

  public function testSetValue()
  {
    $row = new RowMatrix([2, 3, 4]);
    $this->assertSame([2, 3, 4], $row->getValues());

    $row->setValues([4, 6, 7]);
    $this->assertSame([4, 6, 7], $row->getValues());

    $this->expectException(\InvalidArgumentException::class);
    $row->setValues([2, 1]);
  }

  public function testSetValueByPosition()
  {
    $row = new RowMatrix([2, 3, 4]);
    $row->setValueByPosition(1, 3);

    $this->assertSame(3, $row->getValueByPosition(1));

    $this->expectException(\OutOfRangeException::class);
    $row->setValueByPosition(4, 5);
  }
}
