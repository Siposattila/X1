<?php

namespace App\Exception;

use App\Constant\ExceptionConstant;
use Exception;

class GameNotFoundException extends Exception
{
    public function __construct(string $message = "")
    {
        parent::__construct($message, ExceptionConstant::GAME_NOT_FOUND);
    }
}
