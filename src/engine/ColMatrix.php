<?php

namespace Farhanisty\Matrix\Engine;

use Farhanisty\Matrix\Exceptions\OutOfRangeException;

class ColMatrix
{
  private array $values;

  public function __construct(array $values)
  {
    $this->values = $values;
  }

  public function getValues(): array
  {
    return $this->values;
  }

  public function getValueByPosition(int $position): int
  {
    if($position > $this->length() || $position < 1) {
      throw new OutOfRangeException();
    }

    return $this->getValues()[$position - 1];
  }

  public function length(): int
  {
    return count($this->getValues());
  }

  public function isSameValues(): bool
  {
    $temp = $this->values[0];

    foreach($this->values as $key => $value) {
      if($value != $temp) {
        return false;
      }
    }

    return true;
  }

  public function isContain(int $searchValue): bool
  {
    foreach($this->values as $value) {
      if($value == $searchValue) {
        return true;
      } 
    }

    return false;
  }
}
