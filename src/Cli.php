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
}

function hello()
{
    $name = \cli\prompt('May I have your name?');
    line("Hello, %s!" . PHP_EOL, $name);

    return $name;
}

function theEnd($name, $result = true)
{
    if ($result) {
        line('Congratulations, %s!', $name);
    } else {
        line('Let\'s try again, %s!', $name);
    }
}

function brainEven()
{
    welcome();
    line('Answer "yes" if number even otherwise answer "no".' . PHP_EOL);
    $name = hello();

    $currRandom = MULT;
    $result = true;
    for ($i = 0; $i < 3; $i++) {
        line("Question: %s", $currRandom);
        $answer = \cli\prompt('Your answer');
        if (isRightAnswer($currRandom, $answer)) {
            line("Correct!");
            $currRandom = getNextRandom($currRandom);
        } else {
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, getCorrectAnswer($currRandom));
            $result = false;
            break;
        }
    }

    theEnd($name, $result);
}

function getNextRandom($curr)
{
    return ($curr * MULT + INCR) % MOD;
}

function getCorrectAnswer($num)
{
    return ($num % 2) ? 'no' : 'yes';
}

function isRightAnswer($num, $answer)
{
    return ($answer == getCorrectAnswer($num)) ? true : false;
}
