<?php

namespace RServices\Transformers\DataTables;

use App\DataTables\SessionTransformer;
use League\Fractal\TransformerAbstract;
use RServices\Models\Session;

class SessionTransformerTransformer extends AbstractTransformer
{

    public function transform(Session $session)
    {
        return [
            'id' => $session->id,
            'user_id' => $session->user->name,
            'ip_address' => $session->ip_address,
            'action' => $this->getAction($session->id),
        ];
    }
}
