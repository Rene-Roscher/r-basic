<?php

namespace RServices\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Select2Transformer extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->select2();
    }
}
