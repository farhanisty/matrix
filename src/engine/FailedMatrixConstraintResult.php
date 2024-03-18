<?php

namespace Farhanisty\Matrix\Engine;

class FailedMatrixConstraintResult implements MatrixConstraintResult
{
  public function __construct(
    private string $message
  ) {
  }

  public function getStatus(): bool
  {
    return false;
  }

  public function getMessage(): string
  {
    return $this->message;
  }
}
