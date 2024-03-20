<?php

namespace Farhanisty\Matrix\Custom\Constraint;

use Farhanisty\Matrix\Engine\FailedMatrixConstraintResult;
use PHPUnit\Framework\TestCase;

final class ValueRangeConstraintTest extends TestCase
{
  public function testBelowRangeInterval()
  {
    $constraint = new ValueRangeConstraint(1, 10, -1);
    $result = $constraint->check();

    $this->assertInstanceOf(FailedMatrixConstraintResult::class, $result);
    $this->assertStringStartsWith("-1 out of interval", $result->getMessage());
  }

  public function testAboveRangeInterval()
  {
    $constraint = new ValueRangeConstraint(1, 10, 11);
    $result = $constraint->check();

    $this->assertInstanceOf(FailedMatrixConstraintResult::class, $result);
    $this->assertStringStartsWith("11 out of interval", $result->getMessage());
  }
}
