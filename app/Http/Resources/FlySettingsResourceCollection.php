<?php

namespace App\Http\Resources;

class FlySettingsResourceCollection extends ResourceCollection
{
    protected function processCollection($request)
    {
        return $this->collection->map(function(FlySettingsResource $resource) use ($request) {
            return $resource->hide($this->withoutFields)->toArray($request);
        })->all();
    }
}
