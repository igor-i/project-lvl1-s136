<?php
/**
 * User: Inkovskiy
 * Date: 11.07.17
 * Time: 1:28
 */

namespace BrainGames\games\even;

use function BrainGames\gameplay\gamePlay;

//function run($getDescription, $getQuestion, $getCorrectAnswer)
//{
//    gamePlay($getDescription, $getQuestion, $getCorrectAnswer);
//    return;
//}

//    line('Welcome to the Brain Game!');
//    echo 'Welcome to the Brain Game!' . PHP_EOL;
//    line($getDescription() . PHP_EOL);
//    echo $description . PHP_EOL;
//    $name = prompt('May I have your name?');
//    line("Hello, %s!" . PHP_EOL, $name);
//    $name = 'Igor';
//    echo "Hello, $name" . PHP_EOL;

// play game
//        line("Question: %s", $question);
//    echo "Question: $question";
//        $answer = prompt('Your answer', 0);
//    $answer = "no";
//    $corAnswer = $getCorrectAnswer($question);
//    if ($corAnswer === false) {
//        error();
//        return;
//    } elseif ($corAnswer == normalize($answer)) {
//        line("Correct!");
//    } else {
//        line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $corAnswer);
//        line('Let\'s try again, %s!', $name);
//        return;
//    }
//
//    line('Congratulations, %s!', $name);
//    return;

//TODO:
// на каждом шаге игрового процесса вызываем лямду, в которой связанными переменными передаём вопрос и ответ,
// а так же передаём не связанным параметром лямду функцию получения правильного ответа (в которую передаём вопрос)
// и сравниваем полученный правильный ответ с ответом из формальных параметров

///// gameplay //////



//$correctAnswer = function ($question) use ($getCorrectAnswer) {
//    return $getCorrectAnswer($question);
//};

/////////

function isEven(Int $num)
{
    return ($num % 2) == 0;
}

function run()
{
    $description = 'Answer "yes" if number even otherwise answer "no".';

    $question = function() {
        return rand(1, 20);
    };

    $correctAnswer = function($question) {
        return (isEven((int)$question)) ? 'yes' : 'no';
    };

    $run = function ($description, $question) use ($correctAnswer) {
        gamePlay($description, $question, $correctAnswer);
    };

    echo $run($description, $question);
}
