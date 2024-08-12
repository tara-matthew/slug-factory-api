<?php

namespace Domain\Shared\Traits;

use Illuminate\Database\Eloquent\Relations\Relation;

trait IdentifiesModels
{
    protected function identifyModel(string $type, int $id)
    {
        $modelClass = collect(Relation::morphMap())->get($type);

        return $modelClass::findOrFail($id);
    }
}
