<?php
/**
 * User: Inkovskiy
 * Date: 11.07.17
 * Time: 1:28
 */

namespace BrainGames\gameplay;

use function cli\line;
use function cli\prompt;
use function BrainGames\lib\normalize;

/**
 * @param $description - Строка с описанием игры
 * @param $question - Лямбда-функция, формирующая строку с вопросом
 * @param $correctAnswer - Лямбда-функция, формирующая строку с правильным ответом
 */
function gamePlay($description, $question, $correctAnswer)
{
    line('Welcome to the Brain Game!');
    line($description . PHP_EOL);
    $name = prompt('May I have your name?');
    line("Hello, %s!" . PHP_EOL, $name);

    for ($i = 0; $i < 3; $i++) {
        $quest = $question();
        line("Question: %s", $quest);
        $answer = prompt('Your answer', 0);
        $corAnswer = $correctAnswer($quest);
        if ($corAnswer == normalize($answer)) {
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
