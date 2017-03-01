<?php

/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 13:28
 */

abstract class Logger
{
    const LEVEL_NOTICE = 1;
    const LEVEL_WARNING = 2;
    const LEVEL_ERROR = 3;
    const LEVEL_FATAL = 4;

    abstract function log($message, $type, $level = self::LEVEL_ERROR);

    protected function levelTitle($level)
    {
        return [
            self::LEVEL_NOTICE  => 'Notice',
            self::LEVEL_WARNING => 'Warning',
            self::LEVEL_ERROR   => 'Error',
            self::LEVEL_FATAL   => 'Fatal'
        ][$level];
    }
}
