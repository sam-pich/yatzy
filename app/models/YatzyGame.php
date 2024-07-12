<?php
namespace Yatzy;

class YatzyGame
{
    public $roll;
    public $dice;
    public $keep;
    public $scores;
    public $totalScore;
    public $sum;

    public function __construct()
    {
        $this->roll = 0;
        $this->dice = [0, 0, 0, 0, 0];
        $this->keep = [false, false, false, false, false];

        $this->totalScore = 0;
        $this->sum = 0;

        $this->scores = [
            'ones' => 0, 'twos' => 0, 'threes' => 0, 'fours' => 0, 'fives' => 0, 'sixes' => 0,
            'three_of_a_kind' => 0, 'four_of_a_kind' => 0, 'full_house' => 0, 'small_straight' => 0,
            'large_straight' => 0, 'yatzy' => 0, 'chance' => 0, 'bonus' => 0
        ];
    }

    public function rollDice()
    {
        for ($i = 0; $i < 5; $i++) {
            if (!$this->keep[$i]) {
                $this->dice[$i] = rand(1, 6);
            }
        }

        $this->roll++;
    }

    public function toggleKeep($index)
    {
        if (count($this->dice) > $index && $index >= 0) {
            $this->keep[$index] = !$this->keep[$index];
        }
    }
}