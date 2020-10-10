<?php


namespace RServices\Helpers;


class StatusPill
{

    public static function success($text = null)
    {
        return "<span class='badge-pill badge-primary text-white'>{$text}</span>";
    }

    public static function danger($text = null)
    {
        return "<span class='badge-pill badge-danger text-white'>{$text}</span>";
    }

    public static function dark($text = null)
    {
        return "<span class='badge-pill badge-dark text-white'>{$text}</span>";
    }

}
