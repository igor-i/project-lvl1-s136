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
    $arrayNum = str_split($strNum);
    sort($arrayNum, SORT_NUMERIC);

    $balanceIter = function ($acc) use (&$balanceIter) {
        if (!is_array($acc)) {
            echo 'упс' . PHP_EOL;
            return false;
        }
        $max = array_pop($acc);
        $min = array_shift($acc);
        if (((int)$max - 1) == (int)$min) {
            $acc[] = $max;
            $acc[] = $min;
            sort($acc, SORT_NUMERIC);
            return $acc;
        } else {
            $acc[] = (int)$max - 1;
            $acc[] = (int)$min + 1;
            sort($acc, SORT_NUMERIC);
            return $balanceIter($acc);
        }
    };

    return $balanceIter($arrayNum);
}

function run()
{
    $description = 'Balance the given number.';

    $question = function () {
        return rand(1, 3);
    };

    $correctAnswer = function ($question) {
        return implode(balance((int)$question));
    };

    $run = function ($description, $question) use ($correctAnswer) {
        gamePlay($description, $question, $correctAnswer);
    };

    echo $run($description, $question);
}
