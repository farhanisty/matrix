<?php

namespace Farhanisty\Matrix\Engine;

class ColMatrix
{
  private array $values;
  private int $position;

  public function __construct(array $values, int $position)
  {
    $this->values = $values;
    $this->position = $position;
  }

  public function getValues(): array
  {
    return $this->values;
  }

  public function getPosition(): int
  {
    return $this->position;
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
