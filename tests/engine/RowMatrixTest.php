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
    $this->row = new RowMatrix([2,3,4,5]);
  }

  public function testGetValues()
  {
    $this->assertSame($this->row->getValues(), [2,3,4,5]);
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
    $row = new RowMatrix([2,2,2,2,2]);
    $this->assertTrue($row->isSameValues());
    $this->assertFalse($this->row->isSameValues());
  }

  public function testIsContain()
  {
    $this->assertTrue($this->row->isContain(2));
    $this->assertTrue($this->row->isContain(5));
    $this->assertFalse($this->row->isContain(10));
  }
}
