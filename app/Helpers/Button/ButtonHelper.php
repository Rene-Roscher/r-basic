<?php


namespace RServices\Helpers\Button;


class ButtonHelper
{

    public static function action($href, $title = 'Edit', $class = 'primary', $margin = null)
    {
        return "<a type=\"button\" class=\"btn btn-sm font-weight-bold {$margin} btn-{$class}\" onclick='location.href = \"{$href}\"'>$title</a>";
    }

    public static function edit($href, $title = 'Edit', $class = 'primary', $margin = null)
    {
        return "<a type=\"button\" class=\"btn btn-sm font-weight-bold {$margin} btn-{$class}\" onclick='location.href = \"{$href}\"'>$title</a>";
    }

    public static function blank($href, $title = 'Edit', $class = 'primary', $margin = null)
    {
        return "<a type=\"button\" target='_blank' class=\"btn btn-sm font-weight-bold {$margin} btn-{$class}\" href='$href'>$title</a>";
    }

    public static function delete($href, $title = 'Delete', $class = 'danger', $margin = null)
    {
        return "<a type=\"button\" class=\"btn btn-sm font-weight-bold {$margin} btn-{$class}\" onclick='confirm(\"Delete?\") ? rservices.request.get(\"{$href}\").handle() : null'>$title</a>";
    }

    public static function addJsDelete($href, $title = 'Delete', $class = 'danger', $margin = null)
    {
        return "<a type=\"button\" class=\"btn btn-sm font-weight-bold {$margin} btn-{$class}\" onclick='rservices.request.deleteConfirm(\"{$href}\").handle()'>$title</a>";
    }

    public static function addDeleteDialogConfirmation($href, $title = 'Delete', $class = 'danger', $margin = null, $dialogTitle = 'Bist du dir sicher?', $dialogText = 'Diese Aktion kann nicht rückgängig gemacht werden!', $dialogConfirmButtonText = 'Ausführen', $dialogIcon = 'warning')
    {
        return "<a type=\"button\" class=\"btn btn-sm font-weight-bold {$margin} btn-{$class}\" onclick='rservices.request.deleteConfirm(\"{$href}\", \"$dialogTitle\", \"$dialogText\", \"$dialogConfirmButtonText\", \"$dialogIcon\").handle(this)'>$title</a>";
    }

    public static function addPostDialogConfirmation($href, $data, $title = 'Run', $class = 'primary', $margin = null, $dialogTitle = 'Bist du dir sicher?', $dialogText = 'Diese Aktion kann nicht rückgängig gemacht werden!', $dialogConfirmButtonText = 'Ausführen', $dialogIcon = 'warning')
    {
        $data = json_encode($data);
        return "<a type=\"button\" class=\"btn btn-sm font-weight-bold {$margin} btn-{$class}\" onclick='rservices.request.postConfirm(\"{$href}\", $data, \"$dialogTitle\", \"$dialogText\", \"$dialogConfirmButtonText\", \"$dialogIcon\").handle(this)'>$title</a>";
    }

    public static function addJsPost($href, $title = 'Action', $class = 'primary', $margin = null)
    {
        return "<a type=\"button\" class=\"btn btn-sm font-weight-bold {$margin} btn-{$class}\" onclick='rservices.request.postConfirm(\"{$href}\").handle()'>$title</a>";
    }

    public static function addJs($href, $title = 'Edit', $class = 'primary', $margin = null)
    {
        return "<a type=\"button\" class=\"btn btn-sm font-weight-bold {$margin} btn-{$class}\" onclick='rservices.request.get(\"{$href}\").handle();'>$title</a>";
    }

    public static function addJsAction($href, $title = 'Edit', $class = 'primary', $margin = null)
    {
        return "<a type=\"button\" class=\"btn btn-sm font-weight-bold {$margin} btn-{$class}\" onclick='rservices.request.get(\"{$href}\").handle();'>$title</a>";
    }

}
