<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivroAssunto extends Model
{
    use HasFactory;
    
    protected $table = 'livro_assuntos';
    protected $fillable = array(
        'livro_id',
        'assunto_id'
    );

    public function livro(){
        return $this->belongsTo(Livro::class);
    }

    public function assunto(){
        return $this->belongsTo(Assunto::class);
    }
}
