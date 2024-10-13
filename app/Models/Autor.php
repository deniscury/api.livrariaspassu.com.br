<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Autor extends Model
{
    use HasFactory;
    
    protected $table = 'autores';
    protected $fillable = array(
        'nome'
    );

    public function livros(){
        return $this->belongsToMany(Livro::class, 'livro_autores', 'autor_id', 'livro_id');
    }

    public function scopeLivrosPorAutor(Builder $query, array $filtros)
    {
        $retorno = $query
            ->with('livros.assuntos')
            ->withWhereHas('livros', 
                function ($query) use ($filtros) {
                        if (isset($filtros['assunto_id'])) {
                            $query->whereHas('assuntos', function ($query) use ($filtros) {
                                    $query->where('id', $filtros['assunto_id']);
                            });
                        }

                    if (isset($filtros['titulo'])) {
                        $query->where('titulo', 'like', '%' . $filtros['titulo'] . '%');
                    }

                    if (isset($filtros['editora'])) {
                        $query->where('editora', 'like', '%' . $filtros['editora'] . '%');
                    }

                    if (isset($filtros['ano_publicacao'])) {
                        $query->where('ano_publicacao', $filtros['ano_publicacao']);
                    }


                    $valorInicio = isset($filtros['valor_inicio']) ? $filtros['valor_inicio'] : 0.00;
                    $valorFim = isset($filtros['valor_fim']) ? $filtros['valor_fim'] : 999999.99;

                    $query->whereBetween('valor', array($valorInicio, $valorFim));
                }
            )
            ->when(isset($filtros['autor_id']), function ($query) use ($filtros) {
                $query->where('autor_id', $filtros['autor_id']);
            });

        return $retorno->get();
    }
}
