<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $location = parent::toArray($request);
        
        $location['contacts'] = json_decode($this->contacts);
        $location['data_sources'] = json_decode($this->data_sources);

        return $location;
    }
}
