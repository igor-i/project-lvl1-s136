<?php
/**
 * User: Inkovskiy
 * Date: 15.07.17
 * Time: 1:47
 */

namespace BrainGames\games\prime;

use function BrainGames\gameplay\gamePlay;

const DESC = 'If a number is a Prime?';

function isPrime(int $num)
{
    if ($num < 2) {
        return false;
    }

    for ($i = 2; $i <= $num / 2; $i++) {
        if (!($num % $i)) {
            return false;
        }
    }

    return true;
}

function run()
{
    $question = function () {
        return rand(-9, 99);
    };

    $correctAnswer = function ($question) {
        return (isPrime((int)$question)) ? 'yes' : 'no';
    };

    gamePlay(DESC, $question, $correctAnswer);
}
