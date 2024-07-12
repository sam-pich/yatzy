<?php
namespace Yatzy\Test;

use Yatzy\YatzyGame;
use Yatzy\YatzyEngine;
use PHPUnit\Framework\TestCase;

class YatzyEngineTest extends TestCase
{
    public function testScoreOnes()
    {
        $game = new YatzyGame();
        $game->dice = [1, 1, 2, 3, 4];
        $this->assertEquals(2, YatzyEngine::scoreOnes($game));
    }

    public function testScoreTwos()
    {
        $game = new YatzyGame();
        $game->dice = [2, 2, 3, 4, 5];
        $this->assertEquals(4, YatzyEngine::scoreTwos($game));
    }

    public function testScoreThrees()
    {
        $game = new YatzyGame();
        $game->dice = [3, 3, 3, 4, 5];
        $this->assertEquals(9, YatzyEngine::scoreThrees($game));
    }

    public function testScoreFourOfAKind()
    {
        $game = new YatzyGame();
        $game->dice = [4, 4, 4, 4, 5];
        $this->assertEquals(21, YatzyEngine::scoreFourOfAKind($game));
    }

    public function testScoreFullHouse()
    {
        $game = new YatzyGame();
        $game->dice = [3, 3, 3, 2, 2];
        $this->assertEquals(25, YatzyEngine::scoreFullHouse($game));
    }

    public function testUpdateScore()
    {
        $game = new YatzyGame();
        $game->scores['ones'] = 3;
        $game->scores['twos'] = 6;
        $game->scores['threes'] = 9;
        $game->scores['fours'] = 12;
        $game->scores['fives'] = 15;
        $game->scores['sixes'] = 18;
        YatzyEngine::updateScore($game);
        $this->assertEquals(63, $game->sum);
        $this->assertEquals(63 + 35, $game->totalScore); // Including bonus
    }
}