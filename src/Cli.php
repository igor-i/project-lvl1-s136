<?php
/**
 * User: Inkovskiy
 * Date: 11.07.17
 * Time: 1:28
 */

namespace BrainGames\Cli;

use function cli\line;

const MULT = 7;
const INCR = 7;
const MOD = 10;

function welcome()
{
    line('Welcome to the Brain Game!');
    return;
}

function hello()
{
    $name = \cli\prompt('May I have your name?');
    line("Hello, %s!" . PHP_EOL, $name);

    return $name;
}

function brainEven()
{
    welcome();
    line('Answer "yes" if number even otherwise answer "no".' . PHP_EOL);
    $name = hello();

    $currRandom = MULT;
    for ($i = 0; $i < 3; $i++) {
        line("Question: %s", $currRandom);
        $answer = \cli\prompt('Your answer');
        if (isRightAnswer($currRandom, clearAnswer($answer))) {
            line("Correct!");
            $currRandom = getNextRandom($currRandom);
        } else {
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, getCorrectAnswer($currRandom));
            line('Let\'s try again, %s!', $name);
            return;
        }
    }

    line('Congratulations, %s!', $name);
    return;
}

function getNextRandom($curr)
{
    return ($curr * MULT + INCR) % MOD;
}

function getCorrectAnswer($num)
{
    return (isEven($num)) ? 'yes' : 'no';
}

function isEven($num)
{
    return ($num % 2) == 0;
}

function isRightAnswer($num, $answer)
{
    switch ($answer) {
        case 'yes':
            return isEven($num);
        case 'no':
            return !isEven($num);
        default:
            return false;
    }
}

function clearAnswer($answer)
{
    return strtolower(trim($answer));
}
