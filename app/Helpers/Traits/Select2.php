<?php


namespace RServices\Helpers\Traits;


trait Select2
{
    protected function select2()
    {
        return [
            'id' => $this->id,
            'text' => $this->name
        ];
    }
}
