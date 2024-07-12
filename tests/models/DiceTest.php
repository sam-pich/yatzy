<?php
namespace Yatzy\Test;

use Yatzy\Dice;
use PHPUnit\Framework\TestCase;

class DiceTest extends TestCase
{
    public function testConstructor()
    {
        $x = new Dice();
        $this->assertEquals(1, $x->min);
        $this->assertEquals(6, $x->max);

        $x = new Dice(10, 20);
        $this->assertEquals(10, $x->min);
        $this->assertEquals(20, $x->max);
    }

    public function testRoll()
    {
        $x = new Dice();

        for ($i = 0; $i < 100; $i++) {
            $roll = $x->roll();
            $this->assertGreaterThanOrEqual(1, $roll);
            $this->assertLessThanOrEqual(6, $roll);
        }
    }
}