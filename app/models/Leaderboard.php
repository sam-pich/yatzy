<?php
namespace Yatzy;

class Leaderboard
{
    private array $scores = [];

    public function addScore($player, $score): void
    {
        $this->scores[] = ['player' => $player, 'score' => $score];

        usort($this->scores, function ($a, $b) {
            return $b['score'] - $a['score'];
        });
    }

    public function getScores(): array
    {
        return $this->scores;
    }
}