<?php
/**
 * User: Inkovskiy
 * Date: 14.07.17
 * Time: 22:38
 */

namespace BrainGames\games\progression;

use function BrainGames\gameplay\gamePlay;

const DESC = 'What number is missing in this progression?';

function findMissingNum(array $sequence)
{
    $missingNum = array_reduce(array_keys($sequence), function ($acc, $key) use ($sequence) {
        if ($sequence[$key] == '..') {
            switch ($key) {
                case 0:
                    return $sequence[$key + 1] - ($sequence[$key + 2] - $sequence[$key + 1]);
                case 9:
                    return $sequence[$key - 1] + ($sequence[$key - 1] - $sequence[$key - 2]);
                default:
                    return $sequence[$key - 1] + ($sequence[$key + 1] - $sequence[$key - 1]) / 2;
            }
        } else {
            return $acc;
        }
    });

    return $missingNum;
}

function run()
{
    $question = function () {
        $first = rand(1, 9);
        $step = rand(1, 9);
        $last = $first * $step * 10;
        $sequence = range($first, $last, $step);
        $skip = rand($first, $last);
        $sequence[$skip] = '..';

        return implode(' ', $sequence);
    };

    $correctAnswer = function ($question) {
        return findMissingNum(explode(' ', $question));
    };

    gamePlay(DESC, $question, $correctAnswer);
}
