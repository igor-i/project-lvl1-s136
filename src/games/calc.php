<?php
/**
 * User: Inkovskiy
 * Date: 13.07.17
 * Time: 13:56
 */

namespace BrainGames\games\calc;

use function BrainGames\gameplay\gamePlay;

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

function run()
{
    $description = 'What is the result of the expression?';

    $question = function () {
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
    };

    $correctAnswer = function ($question) {
        list($num1, $operation, $num2) = explode(' ', $question);
        return calc((int)$num1, (int)$num2, $operation);
    };

    $run = function ($description, $question) use ($correctAnswer) {
        gamePlay($description, $question, $correctAnswer);
    };

    echo $run($description, $question);
}
