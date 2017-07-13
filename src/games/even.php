<?php
/**
 * User: Inkovskiy
 * Date: 11.07.17
 * Time: 1:28
 */

namespace BrainGames\games\even;

function getDescription()
{
    return 'Answer "yes" if number even otherwise answer "no".';
}

function getQuestion(Int $step)
{
    return rand();
}

function getCorrectAnswer($question)
{
    return (isEven((int)$question)) ? 'yes' : 'no';
}

function isEven(Int $num)
{
    return ($num % 2) == 0;
}
