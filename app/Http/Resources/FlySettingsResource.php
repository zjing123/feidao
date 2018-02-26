<?php

namespace App\Http\Resources;

class FlySettingsResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->filterFields(
            array_merge([
                'id'           => $this->number,
                'angles'       => $this->angles,
                'gravity'      => $this->gravity,
                'power'        => $this->power,
                'scale'        => $this->scale,
                'rX'           => $this->rx,
                'rY'           => $this->ry,
                'rZ'           => $this->rz,
                'autoInterVal' => $this->auto_interval,
                'autoX'        => $this->auto_x,
                'autoY'        => $this->auto_y,
                'autoD'        => $this->auto_d,
                'created_at'   => $this->created_at,
                'updated_at'   => $this->updated_at
            ], parent::toArray($request))
        );
    }

    public static function collection($resource)
    {
        return tap(new FlySettingsResourceCollection($resource), function($collection) {
            $collection->collects = __CLASS__;
        });
    }
}
