<?php

namespace Farhanisty\Matrix\Engine;

use Farhanisty\Matrix\Custom\Constraint\SetTypeOfArrayConstraint;
use Farhanisty\Matrix\Custom\Constraint\MustBeSameValueConstraint;
use Farhanisty\Matrix\Custom\Constraint\ValueRangeConstraint;
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

  public function setValues(array $values): void
  {
    $constraint = new SetTypeOfArrayConstraint($values, "integer");
    $constraint->setNext(new MustBeSameValueConstraint($this->length(), count($values)));

    $result = $constraint->check();

    if (!$result->getStatus()) {
      throw new \InvalidArgumentException($result->getMessage());
    }
    $this->values = $values;
  }

  public function setValueByPosition(int $position, float $value): void
  {
    $constraint = new ValueRangeConstraint(1, $this->length(), $position);
    $result = $constraint->check();

    if (!$result->getStatus()) {
      throw new \OutOfRangeException($result->getMessage());
    }

    $this->values[$position - 1] = $value;
  }

  public function getValueByPosition(int $position): float
  {
    if ($position > $this->length() || $position < 1) {
      throw new OutOfRangeException();
    }

    return $this->getValues()[$position - 1];
  }

  public function length(): int
  {
    return count($this->getValues());
  }

  public function multiplyValues(): float
  {
    $result = 1;

    foreach ($this->getValues() as $value) {
      $result *= $value;
    }

    return $result;
  }

  public function isSameValues(): bool
  {
    $temp = $this->values[0];

    foreach ($this->values as $key => $value) {
      if ($value != $temp) {
        return false;
      }
    }

    return true;
  }

  public function isContain(float $searchValue): bool
  {
    foreach ($this->values as $value) {
      if ($value == $searchValue) {
        return true;
      }
    }

    return false;
  }
}
