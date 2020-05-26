<?php

namespace App\Traits;

use Vinkla\Hashids\Facades\Hashids;

trait Hashidable
{
    public function getRouteKey()
    {
        return Hashids::connection(get_called_class())->encode($this->getKey());
    }

    private function getModel($model, $routeKey)
    {
        $id = Hashids::connection($model)->decode($routeKey)[0] ?? null;
        $modelInstance = resolve($model);

        return $modelInstance->findOrFail($id);
    }

    public function getHashidAttribute()
    {
        return Hashids::encode($this->attributes['id']);
    }
}
