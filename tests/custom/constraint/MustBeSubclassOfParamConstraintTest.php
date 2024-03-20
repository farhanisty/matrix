<?php

namespace Farhanisty\Matrix\Custom\Constraint;

use Farhanisty\Matrix\Engine\Matrix;
use PHPUnit\Framework\TestCase;

abstract class Foo
{
  abstract public function run(): string;
}

class Bar extends Foo
{
  public function run(): string
  {
    return "hello world";
  }
}

class MustBeSubclassOfParamConstraintTest extends TestCase
{
  public function testTrueCheck()
  {
    $bar = new Bar();
    $constraint = new MustBeSubclassOfParamConstraint($bar, Foo::class);
    $constraintResult = $constraint->check();

    $this->assertTrue($constraintResult->getStatus());
  }

  public function testFalseCheck()
  {
    $matrix = new Matrix(1, 1, [[1]]);
    $constraint = new MustBeSubclassOfParamConstraint($matrix, Foo::class);
    $constraintResult = $constraint->check();

    $this->assertFalse($constraintResult->getStatus());
  }
}
