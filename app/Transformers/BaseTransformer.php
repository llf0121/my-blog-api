<?php

namespace App\Transformers;
use League\Fractal\TransformerAbstract;

class BaseTransformer extends  TransformerAbstract
{
    public function nullObject()
    {
        return $this->primitive((object) null);
    }
}
