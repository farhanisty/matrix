<?php

namespace Farhanisty\Matrix\Facades\ERO;

use Farhanisty\Matrix\Custom\Operation\ERO\ScalarMultiplicationRowOperation;
use Farhanisty\Matrix\Custom\Operation\ERO\SumByMultiplesOfOtherRowOperation;
use Farhanisty\Matrix\Custom\Operation\ERO\SwapRowOperation;
use Farhanisty\Matrix\Engine\Matrix;

class ElementaryRowOperationImpl implements ElementaryRowOperation
{
  private ?Matrix $matrix;
  private int $position = 0;
  private array $operations = [];

  public function scalarMultiplication(float $scalar, int $row): void
  {
    $this->operations[] = new ScalarMultiplicationRowOperation($scalar, $row);
  }

  public function swapRow(int $firstRow, int $secondRow): void
  {
    $this->operations[] = new SwapRowOperation($firstRow, $secondRow);
  }

  public function sumByMultiplesOfOtherRow(float $scalar, int $otherRow, int $mainRow)
  {
    $this->operations[] = new SumByMultiplesOfOtherRowOperation($scalar, $otherRow, $mainRow);
  }

  public function length(): int
  {
    return count($this->operations);
  }

  public function getPosition(): ?int
  {
    if ($this->length()) {
      return $this->position + 1;
    }

    return null;
  }

  public function resetPosition(): void
  {
    if ($this->position) {
      $this->position = 0;
    }
  }

  public function lastPosition(): void
  {
    if ($this->getPosition()) {
      $this->position = $this->length() - 1;
    }
  }

  public function setMatrix(Matrix $matrix): void
  {
    $this->matrix = $matrix;
  }

  public function undo(): void
  {
    $eroOperation = $this->operations[$this->getPosition() - 1];
    $eroOperation->setMatrix($this->matrix);

    $eroOperation->undo($this->matrix);
  }

  public function execute(): void
  {
    $eroOperation = $this->operations[$this->getPosition() - 1];
    $eroOperation->setMatrix($this->matrix);

    $eroOperation->executeTo($this->matrix);
  }

  public function executeAll(): void
  {
    $this->resetPosition();

    do {
      $this->execute();
    } while ($this->next());
  }

  public function next(): bool
  {
    $result = ($this->getPosition() < $this->length()) ? true : false;

    if ($this->getPosition() < $this->length()) {
      $this->position += 1;
    }

    return $result;
  }

  public function prev(): bool
  {
    $result = ($this->getPosition() > 1) ? true : false;

    if ($this->getPosition() > 1) {
      $this->position -= 1;
    }

    return $result;
  }
}
