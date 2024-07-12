<?php
namespace Yatzy;

class YatzyEngine
{
    public static function scoreOnes($game)
    {
        return array_sum(array_filter($game->dice, function ($die) {
            return $die == 1;
        }));
    }

    public static function scoreTwos($game)
    {
        return array_sum(array_filter($game->dice, function ($die) {
            return $die == 2;
        }));
    }

    public static function scoreThrees($game)
    {
        return array_sum(array_filter($game->dice, function ($die) {
            return $die == 3;
        }));
    }

    public static function scoreFourOfAKind($game)
    {
        $counter= array_count_values($game->dice);
        
        foreach ($counter as $value => $count) {
            if ($count >= 4) {
                return array_sum($game->dice);
            }
        }
        
        return 0;
    }

    public static function scoreFullHouse($game)
    {
        $counts = array_count_values($game->dice);
        
        if (count($counts) == 2 && min($counts) == 2&& max($counts) == 3 ) {
            return 25;
        }
        return 0;
    }

    public static function updateScore($game)
    {
        $game->totalScore = array_sum($game->scores);
        
        $game->sum = $game->scores['ones'] + $game->scores['twos'] + $game->scores['threes'] + $game->scores['fours'] +$game->scores['fives'] + $game->scores['sixes'];

        if ($game->sum >= 63) {
            $game->scores['bonus'] = 35;
        } else {
            $game->scores['bonus'] = 0;
        }

        $game-> totalScore += $game->scores['bonus'];

    }
}