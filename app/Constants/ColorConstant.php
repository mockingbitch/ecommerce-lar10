<?php

namespace App\Constants;

class ColorConstant
{
    public const COLOR_RED      = 'red';
    public const COLOR_GREEN    = 'green';
    public const COLOR_YELLOW   = 'yellow';
    public const COLOR_BLUE     = 'blue';
    public const COLOR_BLACK    = 'black';
    public const COLOR_GRAY     = 'gray';
    public const COLOR_GOLD     = 'gold';
    public const COLOR_WHITE    = 'white';

    public const COLOR = [
        self::COLOR_RED     => 'Đỏ',
        self::COLOR_GREEN   => self::COLOR_GREEN,
        self::COLOR_YELLOW  => self::COLOR_YELLOW,
        self::COLOR_BLUE    => self::COLOR_BLUE,
        self::COLOR_BLACK   => self::COLOR_BLACK,
        self::COLOR_GRAY    => self::COLOR_GRAY,
        self::COLOR_GOLD    => self::COLOR_GOLD,
        self::COLOR_WHITE   => self::COLOR_WHITE
    ];
}
