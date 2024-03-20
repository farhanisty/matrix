<?php

namespace Farhanisty\Matrix\Engine;

use Farhanisty\Matrix\Custom\Constraint\ValueRangeConstraint;
use Farhanisty\Matrix\Custom\Constraint\MustBeSameValueConstraint;
use Farhanisty\Matrix\Engine\ColMatrix;
use Farhanisty\Matrix\Engine\RowMatrix;
use Farhanisty\Matrix\Exceptions;

class Matrix
{
  private int $height;
  private int $width;
  private array $values;

  public function __construct(int $height, int $width, array $values)
  {
    $this->initialize($height, $width, $values);
  }

  public function initialize(int $height, int $width, array $values): void
  {
    if (!$this->validate($height, $width, $values)) {
      throw new \Exception("values is not valid");
    }

    $this->height = $height;
    $this->width = $width;
    $this->values = $values;
  }

  public static function validate(int $height, int $width, array $values): bool
  {
    if ($height < 0 || $width < 0) {
      throw new Exceptions\InvalidMatrixSizeException();
    }

    if (count($values) != $height) {
      throw new Exceptions\InvalidMatrixInitializationException("Matrix height not same as height setted");
    }

    foreach ($values as $v) {
      if (count($v) != $width) {
        throw new Exceptions\InvalidMatrixInitializationException("Matrix width not same as width setted");
      }
    }

    return true;
  }

  public function getByPosition(int $row, int $col): int
  {
    if ($row < 1 || $row > $this->getHeight() || $col < 1 || $col > $this->getWidth()) {
      throw new Exceptions\OutOfRangeException();
    }
    return $this->getValues()[$row - 1][$col - 1];
  }

  public function setByPosition(int $row, int $col, float $value)
  {
    $constraint = new ValueRangeConstraint(1, $this->getHeight(), $row);
    $constraint->setNext(new ValueRangeConstraint(1, $this->getWidth(), $col));

    $constraintResult = $constraint->check();

    if (!$constraintResult->getStatus()) {
      throw OutOfRangeException($constraintResult->getMessage());
    }

    $this->values[$row - 1][$col - 1] = $value;
  }

  public function replaceRow(int $position, array $row)
  {
    $constraint = new ValueRangeConstraint(1, $this->getHeight(), $position);
    $constraint->setNext(new MustBeSameValueConstraint(count($row), $this->getWidth()));

    if (!$constraint->check()->getStatus()) {
      throw new Exceptions\InvalidMatrixValueException($constraint->check()->getMessage());
    }

    $this->values[$position - 1] = $row;
  }

  public function getRow(int $position)
  {
    if ($position < 0 || $position > $this->getHeight()) {
      throw new Exceptions\OutOfRangeException("out of range. position must be not more than matrix height");
    }

    return new RowMatrix($this->getValues()[$position - 1]);
  }

  public function getAllRows(): array
  {
    $rows = [];

    foreach ($this->getValues() as $value) {
      $rows[] = new RowMatrix($value);
    }

    return $rows;
  }

  public function replaceCol(int $position, array $col)
  {
    $constraint = new ValueRangeConstraint(1, $this->getWidth(), $position);
    $constraint->setNext(new MustBeSameValueConstraint(count($col), $this->getHeight()));

    if (!$constraint->check()->getStatus()) {
      throw new Exceptions\InvalidMatrixValueException($constraint->check()->getMessage());
    }

    echo "tidak error";
    for ($i = 0; $i < $this->getHeight(); $i++) {
      $this->values[$i][$position - 1] = $col[$i];
    }
  }

  public function getCol(int $position)
  {
    if ($position < 0 || $position > $this->getWidth()) {
      throw new Exceptions\OutOfRangeException("position must be not more than matrix height");
    }

    $temp = [];

    foreach ($this->getValues() as $value) {
      $temp[] = $value[$position - 1];
    }

    return new ColMatrix($temp);
  }

  public function getAllCols(): array
  {
    $temp = [];

    foreach ($this->getValues() as $keyValue => $value) {
      foreach ($value as $index => $v) {
        $temp[$index][$keyValue] = $v;
      }
    }

    $cols = [];

    foreach ($temp as $t) {
      $cols[] = new ColMatrix($t);
    }

    return $cols;
  }

  public function getValues(): array
  {
    return $this->values;
  }

  public function isEqual(Matrix $otherMatrix): bool
  {
    return serialize($this) == serialize($otherMatrix);
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
