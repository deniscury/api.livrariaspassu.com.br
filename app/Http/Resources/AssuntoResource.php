<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssuntoResource extends JsonResource
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
            'descricao' => $this->descricao,
            'livros' => new LivrosCollection($this->whenLoaded('livros')),
            'links' => array(
                array(
                    'rel' => 'Alterar assunto',
                    'type' => 'PATCH',
                    'url' => route('assunto.update', $this->id)
                ),
                array(
                    'rel' => 'Excluir assunto',
                    'type' => 'DELETE',
                    'url' => route('assunto.destroy', $this->id)
                )
            )
        );
    }
}
