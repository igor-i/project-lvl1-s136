<?php
/**
 * User: Inkovskiy
 * Date: 11.07.17
 * Time: 1:28
 */

namespace BrainGames\games\even;

use function BrainGames\gameplay\gamePlay;

const DESC = 'Answer "yes" if number even otherwise answer "no".';

function isEven(Int $num)
{
    return ($num % 2) == 0;
}

function run()
{
    $question = function () {
        return rand(1, 20);
    };

    $correctAnswer = function ($question) {
        return (isEven((int)$question)) ? 'yes' : 'no';
    };

    gamePlay(DESC, $question, $correctAnswer);
}
