<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $parent = parent::toArray($request);
        $data['products'] = $this -> products() -> paginate(6);
        return [
            'status' => 'success',
            'message' => 'category data',
            'data' => $data
        ];
    }
}
