<?php

namespace RServices\Helpers;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Utilities
{

    public static function randomStringWithSpecialCharacters(int $length = 16): string
    {
        $string = Str::random($length);
        try {
            for ($i = 0; $i < random_int(2, 6); $i++) {
                $character = ['!', '@', '=', '.', '+', '^'][random_int(0, 5)];
                $string = substr_replace($string, $character, random_int(0, $length - 1), 1);
            }
        } catch (Exception $exception) {
            Log::error($exception);
        }
        return $string;
    }
}
