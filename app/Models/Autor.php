<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
