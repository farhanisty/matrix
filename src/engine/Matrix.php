<?php

namespace Farhanisty\Matrix\Engine;

use Farhanisty\Matrix\Engine\ColMatrix;
use Farhanisty\Matrix\Engine\RowMatrix;

class Matrix
{
  private int $height;
  private int $width;
  private array $values;

  public function __construct(int $height, int $width, array $values)
  {
    $this->initialize($height, $width, $values);
  }

  private function initialize(int $height, int $width, array $values): void
  {
    if(!$this->validate($height, $width, $values)) {
      throw new \Exception("values is not valid");
    }

    $this->height = $height;
    $this->width = $width;
    $this->values = $values;
  }

  public static function validate(int $height, int $width, array $values): bool
  {
    if($height < 0 || $width < 0) {
      throw new \Exception("size is not valid. must be unsigned int");
    }

    if(count($values) != $height) {
      return false;
    }

    foreach($values as $v) {
      if(count($v) != $width) {
        return false;
      }
    }

    return true;
  }

  public function getByPosition(int $row, int $col): int
  {
    return $this-getValues()[$row][$col];
  }

  public function getRow(int $position) 
  {
    if($this->getHeight() < $position) {
      throw new \Exception("position must be not more than matrix height");
    }

    return new RowMatrix($this->getValues()[$position - 1], $position);
  }

  public function getAllRows(): array
  {
    $rows = [];

    foreach($this->getValues() as $key => $value) {
      $rows[] = new RowMatrix($value, $key + 1);
    }

    return $rows;
  }

  public function getCol(int $position)
  {
    if($this->getWidth() < $position) {
      throw new \Exception("position must be not more than matrix width");
    }

    $temp = [];

    foreach($this->getValues() as $value) {
      $temp[] = $value[$position - 1];
    }

    return new ColMatrix($temp, $position);
  }

  public function getAllCols(): array
  {
    $temp = [];

    foreach($this->getValues() as $keyValue => $value) {
      foreach($value as $index => $v) {
        $temp[$index][$keyValue] = $v;
      }
    }

    $cols = [];

    foreach($temp as $key => $t) {
      $cols[] = new ColMatrix($t, $key + 1);
    }

    return $cols;
  }

  public function getValues(): array
  {
    return $this->values;
  }

  public function getHeight(): int
  {
    return $this->height;
  }

  public function getWidth(): int
  {
    return $this->width;
  }
}
