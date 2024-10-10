<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LivroAssuntoResource extends JsonResource
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
            'assunto_id' => $this->assunto_id,
            'livro' => new LivroResource($this->whenLoaded('livro')),
            'assunto' => new AssuntoResource($this->whenLoaded('assunto')),
            'links' => array(
                array(
                    'rel' => 'Excluir vínculo',
                    'type' => 'DELETE',
                    'url' => route('livro-assunto.destroy', array($this->livro_id, $this->assunto_id))
                )
            )
        );
    }
}
