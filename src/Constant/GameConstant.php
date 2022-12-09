<?php

namespace App\Constant;

class GameConstant
{
    public const GAME_INACTIVE = 0;
    public const GAME_STARTING = 1;
    public const GAME_ACTIVE = 2;

    public const GAME_OPTIONS = [
        self::GAME_INACTIVE => "inactive",
        self::GAME_STARTING => "starting",
        self::GAME_ACTIVE => "active"
    ];
}
