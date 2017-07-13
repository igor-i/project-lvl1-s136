<?php
/**
 * User: Inkovskiy
 * Date: 11.07.17
 * Time: 1:28
 */

namespace BrainGames\loader;

use function cli\line;

function run($game)
{
    $namespace = buildNamespace('', 'BrainGames', 'games', $game, '');
    $filePath = buildFilePath('games', $game);
    requireFile($filePath);
    $getDescription = $namespace . 'getDescription';
    $desc = $getDescription();
    welcome();
    line($desc . PHP_EOL);
    $name = hello();
}

// TODO переключиться на основную ветку, закоммитить, обновить пакет и проверить как приветствие отработает
// TODO потом сделать функцию с циклом и из неё вызывать для каждого шага соответствующую функцию текущей игры

function requireFile($filePath)
{
    require $filePath;
}

function buildFilePath(...$segments) {
    return implode(DIRECTORY_SEPARATOR, $segments) . '.php';
}

function buildNamespace(...$segments) {
    return implode('\\', $segments);
}

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