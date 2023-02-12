<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SneakersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public static $wrap='sneakers';

    public function toArray($request)
    {
        return [
            'model'=> $this -> resource->model,
            'color'=> $this -> resource->color,
            'releaseYear' => $this -> resource->releaseYear,
            'brand_id'=> new BrandResource($this -> resource->brand),
            'type_id'=>new TypeResource($this -> resource->type),
            'user_id'=>new UserResource($this -> resource->user)
        ];
    }
}
