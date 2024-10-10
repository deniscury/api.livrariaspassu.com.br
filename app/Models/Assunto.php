<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    use HasFactory;
    
    protected $table = 'assuntos';
    protected $fillable = array(
        'descricao'
    );

    public function livros(){
        return $this->belongsToMany(Livro::class, 'livro_assuntos', 'livro_id', 'assunto_id');
    }
}
