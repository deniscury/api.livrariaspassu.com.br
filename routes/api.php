<?php

use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LivroAssuntoController;
use App\Http\Controllers\LivroAutorController;
use App\Http\Controllers\LivroController;
use Illuminate\Support\Facades\Route;

Route::prefix('assunto')->group(function(){
    Route::get('', 
        array(
            AssuntoController::class,
            'index'
        )
    )->name('assunto.index');

    Route::get('quantidade-registros', 
        array(
            AssuntoController::class,
            'quantidadeRegistros'
        )
    )->name('assunto.registros');

    Route::post('', 
        array(
            AssuntoController::class,
            'store'
        )
    )->name('assunto.store');

    Route::get('{assunto}', 
        array(
            AssuntoController::class,
            'show'
        )
    )->name('assunto.show');

    Route::patch('{assunto}', 
        array(
            AssuntoController::class,
            'update'
        )
    )->name('assunto.update');

    Route::delete('{assunto}', 
        array(
            AssuntoController::class,
            'destroy'
        )
    )->name('assunto.destroy');
});

Route::prefix('autor')->group(function(){
    Route::get('', 
        array(
            AutorController::class,
            'index'
        )
    )->name('autor.index');

    Route::get('quantidade-registros', 
        array(
            AutorController::class,
            'quantidadeRegistros'
        )
    )->name('autor.registros');

    Route::post('', 
        array(
            AutorController::class,
            'store'
        )
    )->name('autor.store');

    Route::get('{assunto}', 
        array(
            AutorController::class,
            'show'
        )
    )->name('autor.show');

    Route::patch('{assunto}', 
        array(
            AutorController::class,
            'update'
        )
    )->name('autor.update');

    Route::delete('{assunto}', 
        array(
            AssuntoController::class,
            'destroy'
        )
    )->name('autor.destroy');
});

Route::prefix('livro')->group(function(){
    Route::get('', 
        array(
            LivroController::class,
            'index'
        )
    )->name('livro.index');

    Route::get('quantidade-registros', 
        array(
            LivroController::class,
            'quantidadeRegistros'
        )
    )->name('livro.registros');

    Route::post('', 
        array(
            LivroController::class,
            'store'
        )
    )->name('livro.store');

    Route::get('{assunto}', 
        array(
            LivroController::class,
            'show'
        )
    )->name('livro.show');

    Route::patch('{assunto}', 
        array(
            LivroController::class,
            'update'
        )
    )->name('livro.update');

    Route::delete('{assunto}', 
        array(
            LivroController::class,
            'destroy'
        )
    )->name('livro.destroy');
});

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
