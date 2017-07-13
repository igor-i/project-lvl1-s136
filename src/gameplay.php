<?php
/**
 * User: Inkovskiy
 * Date: 11.07.17
 * Time: 1:28
 */

namespace BrainGames\gameplay;

use function cli\line;
use function cli\prompt;
use function BrainGames\lib\buildNamespace;
use function BrainGames\lib\buildFilePath;
use function BrainGames\lib\normalize;
use function BrainGames\lib\error;


function gamePlay($description, $question, $correctAnswer)
{
    line('Welcome to the Brain Game!');
    line($description . PHP_EOL);
    $name = prompt('May I have your name?');
    line("Hello, %s!" . PHP_EOL, $name);

    // play game
    for ($i = 0; $i < 3; $i++) {
        line("Question: %s", $question);
        $answer = prompt('Your answer', 0);
        $corAnswer = $correctAnswer($question);
        if ($corAnswer === false) {
            error();
            return;
        } elseif ($corAnswer == normalize($answer)) {
            line("Correct!");
        } else {
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $corAnswer);
            line('Let\'s try again, %s!', $name);
            return;
        }
    }

    line('Congratulations, %s!', $name);
    return;
}

function run($game)
{
    $namespace = buildNamespace('', 'BrainGames', 'games', $game, '');
    $filePath = buildFilePath('games', $game);
    require $filePath;

    $getDescription = $namespace . 'getDescription';
    $desc = $getDescription();
    line('Welcome to the Brain Game!');
    line($desc . PHP_EOL);
    $name = prompt('May I have your name?');
    line("Hello, %s!" . PHP_EOL, $name);

    // play game
    for ($i = 1; $i < 4; $i++) {
        $getQuestion = $namespace . 'getQuestion';
        //TODO в getQuestion() передаётся номер текущего шага на тот случай, если для какой-то игры вопрос будет зависеть от номера шага
        $question = $getQuestion($i);
        if ($question === false) {
            error();
            return;
        }
        line("Question: %s", $question);
        $answer = prompt('Your answer', 0);
        $getCorrectAnswer = $namespace . 'getCorrectAnswer';
        $correctAnswer = $getCorrectAnswer($question);
        if ($correctAnswer === false) {
            error();
            return;
        } elseif ($correctAnswer == normalize($answer)) {
            line("Correct!");
        } else {
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $correctAnswer);
            line('Let\'s try again, %s!', $name);
            return;
        }
    }

    line('Congratulations, %s!', $name);
    return;
}
