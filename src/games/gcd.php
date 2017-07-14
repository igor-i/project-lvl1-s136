<?php
/**
 * User: Inkovskiy
 * Date: 13.07.17
 * Time: 13:56
 */

namespace BrainGames\games\gcd;

use function BrainGames\gameplay\gamePlay;

function gcd(Int $num1, Int $num2)
{
    if ($num1 < $num2) {
        $min = $num1;
        $max = $num2;
    } else {
        $min = $num2;
        $max = $num1;
    }

    $commonDivisor = function ($acc) use (&$commonDivisor, $min, $max) {
        if (!($min % $acc) && !($max % $acc)) {
            return $acc;
        }
        return $commonDivisor($acc - 1);
    };

    return $commonDivisor($min);
}

function run()
{
    $description = 'Find the greatest common divisor of given numbers.';

    $question = function () {
        $num1 = rand(1, 20);
        $num2 = rand(1, 20);

        return $num1 . ' ' . $num2;
    };

    $correctAnswer = function ($question) {
        list($num1, $num2) = explode(' ', $question);
        return gcd((int)$num1, (int)$num2);
    };

    $run = function ($description, $question) use ($correctAnswer) {
        gamePlay($description, $question, $correctAnswer);
    };

    echo $run($description, $question);
}
