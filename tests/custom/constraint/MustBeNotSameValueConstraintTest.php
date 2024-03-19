<?php

namespace Farhanisty\Matrix\Custom\Constraint;

use PHPUnit\Framework\TestCase;

class MustBeNotSameValueConstraintTest extends TestCase
{
  public function testCheck()
  {
    $constraint = new MustBeSameValueConstraint(1, 2);
    $result = $constraint->check();
    $this->assertTrue($result->getStatus());

    $constraint = new MustBeSameValueConstraint(5, 5);
    $result = $constraint->check();
    $this->assertFalse($result->getStatus());
  }
}
