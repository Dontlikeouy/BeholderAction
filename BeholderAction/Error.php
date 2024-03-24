<?php

namespace BeholderAction;

class Error
{
    public static function writeError($ex)
    {
        $fileError = "error_log.txt";
        while (true) {
            if (is_writable($fileError) || !file_exists($fileError)) {
                $file = fopen($fileError, "a");
                fwrite($file, date('l jS \of F Y h:i:s A') . "\n");
                fwrite($file, $ex . "\n");
                fclose($file);
                break;
            }
            sleep(10);
        }
    }
}
