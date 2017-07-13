<?php
/**
 * User: Inkovskiy
 * Date: 13.07.17
 * Time: 13:56
 */

namespace BrainGames\games\calc;

use function BrainGames\lib\normalize;

function getDescription()
{
    return 'What is the result of the expression?';
}

function getQuestion(Int $step)
{
    $num1 = rand(0, 20);
    $num2 = rand(0, 20);

    switch (rand(1, 3)) {
        case 1:
            return $num1 . ' + ' . $num2;
        case 2:
            return $num1 . ' - ' . $num2;
        default:
            return $num1 . ' * ' . $num2;
    }
}

function getCorrectAnswer($question)
{
    list($num1, $operation, $num2) = $question;
    return calc((int)normalize($num1), (int)normalize($num2), normalize($operation));
}

function calc(Int $num1, Int $num2, $operation)
{
    switch ($operation) {
        case '+':
            return $num1 + $num2;
        case '-':
            return $num1 - $num2;
        case '*':
            return $num1 * $num2;
        default:
            return false;
    }
}
