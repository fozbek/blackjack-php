<?php

namespace App\Helpers;

class CliHelper
{
    /**
     * @param $message
     * @return string
     */
    public static function readLine($message)
    {
        echo "{$message}: ";
        $handle = fopen ("php://stdin","r");
        return trim(fgets($handle));
    }

    public static function startCountdown($time)
    {
        while ($time > 0) {
            sleep(1);
            echo "{$time} " . PHP_EOL;
            $time--;
        }
    }
}