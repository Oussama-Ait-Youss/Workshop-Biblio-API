<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array{
    
        // return parent::toArray($request);
        return [
             'id'             => $this->id,
             'title'          => $this->title,
             'author'         => $this->author,
             'isbn'           => $this->isbn,
             'published_year' => $this->published_year,
             'category'       => new CategoryResource( $this->whenLoaded('category')),
             'created_at'     => $this->created_at->format('Y-m-d H:i'),
         ];
}
}
