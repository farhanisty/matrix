<?php

namespace Farhanisty\Matrix\Custom\Constraint;

use PHPUnit\Framework\TestCase;

class SetTypeOfArrayConstraintTest extends TestCase
{
  public function testCheck()
  {
    $array = [1, 2, 6, 5, 12, 90];
    $array2 = [1, 3, "hallo"];

    $constraint = new SetTypeOFArrayConstraint($array, "integer");
    $constraint2 = new SetTypeOFArrayConstraint($array2, "integer");

    $this->assertTrue($constraint->check()->getStatus());
    $this->assertFalse($constraint2->check()->getStatus());
  }
}
