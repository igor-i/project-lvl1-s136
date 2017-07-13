<?php
/**
 * User: Inkovskiy
 * Date: 13.07.17
 * Time: 0:49
 */

namespace BrainGames\lib;

use function cli\line;

function buildFilePath(...$segments)
{
    return implode(DIRECTORY_SEPARATOR, $segments) . '.php';
}

function buildNamespace(...$segments)
{
    return implode('\\', $segments);
}

function normalize($answer)
{
    return mb_strtolower(trim($answer));
}

function error()
{
    line("Sorry, an error occurred");
}
