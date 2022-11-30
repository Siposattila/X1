<?php

namespace App\Constant;

class CardConstant
{
    public const CARD_PACK_SIZE = 52;

    public const CARD_COLOUR_SPADES = 1;
    public const CARD_COLOUR_HEARTS = 2;
    public const CARD_COLOUR_CLUBS = 3;
    public const CARD_COLOUR_DIAMONDS = 4;

    public const CARD_COLOUR_OPTIONS = [
        self::CARD_COLOUR_SPADES => "spades",
        self::CARD_COLOUR_HEARTS => "hearts",
        self::CARD_COLOUR_CLUBS => "clubs",
        self::CARD_COLOUR_DIAMONDS => "diamonds"
    ];

    public static function getColourByName(string $colour)
    {
        $colours = array_flip(self::CARD_COLOUR_OPTIONS);

        return $colours[strtolower($colour)];
    }

    public static function getColourName(int $colour)
    {
        return self::CARD_COLOUR_OPTIONS[$colour];
    }
}
