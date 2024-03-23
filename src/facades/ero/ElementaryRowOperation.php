<?php

namespace Farhanisty\Matrix\Facades\ERO;

use Farhanisty\Matrix\Engine\Matrix;

interface ElementaryRowOperation
{
  public function scalarMultiplication(float $scalar, int $row): void;
  public function swapRow(int $firstRow, int $secondRow): void;
  public function sumByMultiplesOfOtherRow(float $scalar, int $otherRow, int $mainRow);
  public function length(): int;
  public function getPosition(): ?int;
  public function resetPosition(): void;
  public function lastPosition(): void;
  public function setMatrix(Matrix $matrix): void;
  public function undo(): void;
  public function next(): bool;
  public function prev(): bool;
  public function execute(): void;
  public function executeAll(): void;
}
