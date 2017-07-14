<?php
/**
 * User: Inkovskiy
 * Date: 13.07.17
 * Time: 13:56
 */

namespace BrainGames\games\balance;

use function BrainGames\gameplay\gamePlay;

function balance(Int $num)
{
    $strNum = (string)$num;
    $arrayNum = explode('', $strNum);

    $balanceIter = function ($acc) use (&$balanceIter) {
        $max = (int)array_pop($acc);
        $min = (int)array_shift($acc);
        if (($max - 1) == $min) {
            $acc[] = $max;
            $acc[] = $min;
            return sort($acc, SORT_NUMERIC);
        } else {
            $acc[] = $max - 1;
            $acc[] = $min + 1;
            return $balanceIter(sort($acc, SORT_NUMERIC));
        }
    };

    return $balanceIter(sort($arrayNum, SORT_NUMERIC));
}

function run()
{
    $description = 'Balance the given number.';

    $question = function () {
        $num = rand(1, 999);
        return $num;
    };

    $correctAnswer = function ($question) {
        return implode(balance((int)$question));
    };

    $run = function ($description, $question) use ($correctAnswer) {
        gamePlay($description, $question, $correctAnswer);
    };

    echo $run($description, $question);
}
