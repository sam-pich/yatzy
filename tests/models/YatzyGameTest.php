<?php
namespace Yatzy\Test;

use Yatzy\YatzyGame;
use PHPUnit\Framework\TestCase;

class YatzyGameTest extends TestCase
{
    public function testConstructor()
    {
        $game = new YatzyGame();
        $this->assertEquals(0, $game->roll);
        $this->assertEquals([0, 0, 0, 0, 0], $game->dice);
        $this->assertEquals([false, false, false, false, false], $game->keep);
        $this->assertEquals(0, $game->totalScore);
        $this->assertEquals(0, $game->sum);

        $this->assertEquals([
            'ones' => 0, 'twos' => 0, 'threes' => 0, 'fours' => 0, 'fives' => 0, 'sixes' => 0,
            'three_of_a_kind' => 0, 'four_of_a_kind' => 0, 'full_house' => 0, 'small_straight' => 0,
            'large_straight' => 0, 'yatzy' => 0, 'chance' => 0, 'bonus' => 0
        ], $game->scores);
    }

    public function testToggleKeep()
    {
        $game = new YatzyGame();
        $game->toggleKeep(2);
        $this->assertTrue($game->keep[2]);
        $game->toggleKeep(2);
        $this->assertFalse($game->keep[2]);
    }
}