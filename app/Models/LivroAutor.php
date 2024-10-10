<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivroAutor extends Model
{
    use HasFactory;
    
    protected $table = 'livro_autores';
    protected $fillable = array(
        'livro_id',
        'autor_id'
    );

    public function livro(){
        return $this->belongsTo(Livro::class);
    }

    public function autor(){
        return $this->belongsTo(Autor::class);
    }
}
