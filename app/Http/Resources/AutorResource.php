<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AutorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array(
            'id' => $this->id,
            'nome' => $this->nome,
            'livros' => new LivrosCollection($this->whenLoaded('livros')),
            'links' => array(
                array(
                    'rel' => 'Alterar autor',
                    'type' => 'PATCH',
                    'url' => route('autor.update', $this->id)
                ),
                array(
                    'rel' => 'Excluir autor',
                    'type' => 'DELETE',
                    'url' => route('autor.destroy', $this->id)
                )
            )
        );
    }
}
