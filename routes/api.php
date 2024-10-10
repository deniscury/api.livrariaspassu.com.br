<?php

use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LivroAssuntoController;
use App\Http\Controllers\LivroAutorController;
use App\Http\Controllers\LivroController;
use Illuminate\Support\Facades\Route;

Route::apiResources(
    array(
        'autor' => AutorController::class,
        'livro' => LivroController::class,
        'assunto' => AssuntoController::class
    )
);

Route::prefix('livro-assunto')->group(function(){
    Route::get('', 
        array(
            LivroAssuntoController::class,
            'index'
        )
    )->name('livro-assunto.index');

    Route::post('', 
        array(
            LivroAssuntoController::class,
            'store'
        )
    )->name('livro-assunto.store');

    Route::get('livro/{livro}/assunto/{assunto}', 
        array(
            LivroAssuntoController::class,
            'show'
        )
    )->name('livro-assunto.show');

    Route::delete('livro/{livro}/assunto/{assunto}', 
        array(
            LivroAssuntoController::class,
            'destroy'
        )
    )->name('livro-assunto.destroy');
});

Route::prefix('livro-autor')->group(function(){
    Route::get('', 
        array(
            LivroAutorController::class,
            'index'
        )
    )->name('livro-autor.index');

    Route::post('', 
        array(
            LivroAutorController::class,
            'store'
        )
    )->name('livro-autor.store');
    
    Route::get('livro/{livro}/autor/{autor}', 
        array(
            LivroAutorController::class,
            'show'
        )
    )->name('livro-autor.show');

    Route::delete('livro/{livro}/autor/{autor}', 
        array(
            LivroAutorController::class,
            'destroy'
        )
    )->name('livro-autor.destroy');
});
