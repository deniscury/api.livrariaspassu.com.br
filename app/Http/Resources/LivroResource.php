<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LivroResource extends JsonResource
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
            'titulo' => $this->titulo,
            'editora' => $this->editora,
            'edicao' => $this->edicao,
            'ano_publicacao' => $this->ano_publicacao,
            'valor' => number_format($this->valor, 2, ',', '.'),
            'autores' => new AutoresCollection($this->whenLoaded('autores')),
            'assuntos' => new AssuntosCollection($this->whenLoaded('assuntos')),
            'links' => array(
                array(
                    'rel' => 'Alterar livro',
                    'type' => 'PATCH',
                    'url' => route('livro.update', $this->id)
                ),
                array(
                    'rel' => 'Excluir livro',
                    'type' => 'DELETE',
                    'url' => route('livro.destroy', $this->id)
                )
            )
        );
    }
}
