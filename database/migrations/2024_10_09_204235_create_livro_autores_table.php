<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('livro_autores', function (Blueprint $table) {
            $table->unsignedBigInteger('livro_id');
            $table->unsignedBigInteger('autor_id');
            $table->timestamps();
            $table->softDeletes();

            $table->primary(
                array(
                    'livro_id',
                    'autor_id'
                )
            );
            
            $table->foreign('livro_id')->references('id')->on('livros')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('autor_id')->references('id')->on('autores')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('livro_autores', function(Blueprint $table){
            $table->dropForeign('livro_autores_livro_id_foreign');
            $table->dropForeign('livro_autores_autor_id_foreign');
        });
        Schema::dropIfExists('livro_autores');
    }
};
