<?php

namespace App\Traits;
use App\Models\Meta;

trait Metaable
{
    public function meta()
    {
        return $this->morphOne(Meta::class, 'metaable');
    }
}
