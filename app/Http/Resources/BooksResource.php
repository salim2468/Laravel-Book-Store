<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BooksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->id,
            'attributes' => [
                'type'=> 'Books',
                'name'=> $this->name,
                'authors'=>$this->author,
                'price'=>$this->price,
                'description'=> $this->description,
                'page_no'=>$this->page_no,
                'language'=>$this->language,
                'isbn'=>$this->isbn,
                'publication_year'=> $this->publication_year,
                'image_path'=>$this->image_path,
                'genere'=>$this->genere,
                'created_at'=> $this->created_at,
                'updated_at'=> $this->updated_at,
            ],];
    }
}
