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
        Schema::create('livro_assuntos', function (Blueprint $table) {
            $table->unsignedBigInteger('livro_id');
            $table->unsignedBigInteger('assunto_id');
            $table->timestamps();
            $table->softDeletes();

            $table->primary(
                array(
                    'livro_id',
                    'assunto_id'
                )
            );
            
            $table->foreign('livro_id')->references('id')->on('livros')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('assunto_id')->references('id')->on('assuntos')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('livro_assuntos', function(Blueprint $table){
            $table->dropForeign('livro_assuntos_livro_id_foreign');
            $table->dropForeign('livro_assuntos_assunto_id_foreign');
        });
        Schema::dropIfExists('livro_assuntos');
    }
};
