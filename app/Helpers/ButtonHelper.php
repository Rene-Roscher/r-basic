<?php


namespace RServices\Helpers;


class ButtonHelper
{

    public static function edit($href, $title = 'Edit', $class = 'primary')
    {
        return "<a type=\"button\" class=\"btn btn-sm font-weight-bold text-white btn-{$class}\" onclick='location.href = \"{$href}\"'>$title</a>";
    }

    public static function blank($href, $title = 'Edit', $class = 'primary')
    {
        return "<a type=\"button\" target='_blank' class=\"btn btn-sm font-weight-bold text-white btn-{$class}\" onclick='location.href = \"{$href}\"'>$title</a>";
    }

}
