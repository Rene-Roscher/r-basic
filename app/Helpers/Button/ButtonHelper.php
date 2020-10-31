<?php


namespace RServices\Helpers\Button;


class ButtonHelper
{

    public static function edit($href, $title = 'Edit', $class = 'primary', $margin = null)
    {
        return "<a type=\"button\" class=\"btn btn-sm font-weight-bold text-white {$margin} btn-{$class}\" onclick='location.href = \"{$href}\"'>$title</a>";
    }

    public static function blank($href, $title = 'Edit', $class = 'primary', $margin = null)
    {
        return "<a type=\"button\" target='_blank' class=\"btn btn-sm font-weight-bold text-white {$margin} btn-{$class}\" href='$href'>$title</a>";
    }

    public static function delete($href, $title = 'Delete', $class = 'danger', $margin = null)
    {
        return "<a type=\"button\" class=\"btn btn-sm font-weight-bold text-white {$margin} btn-{$class}\" onclick='confirm(\"Delete?\") ? rservices.request.get(\"{$href}\").handle() : null'>$title</a>";
    }

    public static function addJs($href, $title = 'Edit', $class = 'primary', $margin = null)
    {
        return "<a type=\"button\" class=\"btn btn-sm font-weight-bold text-white {$margin} btn-{$class}\" onclick='rservices.request.get(\"{$href}\").handle();'>$title</a>";
    }

}
