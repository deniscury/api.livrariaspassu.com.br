<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;
    
    protected $table = 'livros';
    protected $fillable = array(
        'titulo',
        'editora',
        'edicao',
        'ano_publicacao',
    );

    public function autores(){
        return $this->belongsToMany(Autor::class, 'livro_autores', 'livro_id', 'autor_id');
    }

    public function assuntos(){
        return $this->belongsToMany(Assunto::class, 'livro_assuntos', 'livro_id', 'assunto_id');
    }
}
