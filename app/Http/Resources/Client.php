<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Client extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        
/*
        return [
            'name' => $this->name,
            'policies' => [
                'policy_type' => $this->policies->type
            ]
        ];
*/
        
        
        return $this->policies;
    }
}
