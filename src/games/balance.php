<?php
/**
 * User: Inkovskiy
 * Date: 13.07.17
 * Time: 13:56
 */

namespace BrainGames\games\balance;

use function BrainGames\gameplay\gamePlay;

const DESC = 'Balance the given number.';

function balance(Int $num)
{
    $strNum = (string)$num;
    $arrayNum = str_split($strNum);
    sort($arrayNum, SORT_NUMERIC);

    $balanceIter = function ($acc) use (&$balanceIter) {
        if ((empty($acc)) || (count($acc) < 2)) {
            return $acc;
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
    $question = function () {
        return rand(11, 999);
    };

    $correctAnswer = function ($question) {
        return implode(balance((int)$question));
    };

    gamePlay(DESC, $question, $correctAnswer);
}
