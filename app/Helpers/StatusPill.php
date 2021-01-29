<?php


namespace RServices\Helpers;


class StatusPill
{

    public static function success($text = null)
    {
        return self::make('success', $text);
    }

    public static function primary($text = null)
    {
        return self::make('primary', $text);
    }

    public static function warning($text = null)
    {
        return self::make('warning', $text);
    }

    public static function info($text = null)
    {
        return self::make('info', $text);
    }

    public static function danger($text = null)
    {
        return self::make('danger', $text);
    }

    public static function dark($text = null)
    {
        return self::make('dark', $text);
    }

    public static function make($color, $text)
    {
        return "<span class='badge bg-$color'>$text</span>";
    }

}
