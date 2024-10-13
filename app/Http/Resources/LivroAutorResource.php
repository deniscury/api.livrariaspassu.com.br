<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LivroAutorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array(
            'livro_id' => $this->livro_id,
            'autor_id' => $this->autor_id,
            'livro' => new LivroResource($this->whenLoaded('livro')),
            'autor' => new AutorResource($this->whenLoaded('autor'))
        );
    }
}
