<?php
/**
 * User: Inkovskiy
 * Date: 13.07.17
 * Time: 0:49
 */

namespace BrainGames\lib;

function normalize($answer)
{
    return mb_strtolower(trim($answer));
}
