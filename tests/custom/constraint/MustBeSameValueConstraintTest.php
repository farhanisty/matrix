<?php

namespace Farhanisty\Matrix\Custom\Constraint;

use Farhanisty\Matrix\Custom\Constraint\MustBeSameValueConstraint;
use Farhanisty\Matrix\Engine\MatrixConstraintResult;
use PHPUnit\Framework\TestCase;

class MustBeSameValueConstraintTest extends TestCase
{
  public function testNotSameValue()
  {
    $constraint = new MustBeSameValueConstraint(1, 2);
    $result = $constraint->check();

    $this->assertInstanceOf(MatrixConstraintResult::class, $result);
    $this->assertFalse($result->getStatus());
  }

  public function testSameValue()
  {
    $constraint = new MustBeSameValueConstraint(3, 3);
    $result = $constraint->check();

    $this->assertTrue($result->getStatus());
  }
}
