<?php

/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 13:44
 */

class FileLogger extends Logger
{
    public function log($message, $type, $level = self::LEVEL_ERROR)
    {
        if (!file_exists('logs/error.log')) {
            try {
                $file = fopen('logs/error.log', 'w');
                fclose($file);
            } catch (Exception $exception) {}
        }

        if (file_exists('logs/error.log')) {
            $message = date('Y-m-d H:i:s') . " {$type} [{$this->levelTitle($level)}] {$message}" . PHP_EOL;
            file_put_contents('logs/error.log', $message, FILE_APPEND);
        }
    }
}
