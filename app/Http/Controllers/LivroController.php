<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\LivroAssunto;
use App\Models\LivroAutor;

use App\Http\Resources\LivroResource;
use App\Http\Resources\LivrosCollection;
use App\Http\Services;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LivroController extends Controller
{
    protected static $texto_mensagem = array('livro');

    public function __construct()
    {
        $regras = array(
            'titulo' => 'required|min:3|max:40',
            'editora' => 'required|min:3|max:40',
            'edicao' => 'required|integer|min:0',
            'ano_publicacao' => 'required|min:4|max:4'
        );

        $this->setRegras($regras);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livros = new LivrosCollection(Livro::all());

        return Services::retorno(Response::HTTP_OK, '', self::$texto_mensagem, $livros);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $erros = Services::validar($request, $this->getRegras());

        if (!empty($erros)) {
            return Services::retorno(Response::HTTP_INTERNAL_SERVER_ERROR, 'erro_cadastro', self::$texto_mensagem, null, $erros);
        }

        $livro = Livro::create($request->all());

        if($livro){
            $livro = new LivroResource($livro);
            return Services::retorno(Response::HTTP_CREATED, 'cadastrado_sucesso', self::$texto_mensagem, $livro);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($livro)
    {
        $livro = Livro::with(array('autores', 'assuntos'))->find($livro);

        if ($livro){
            $livro = new LivroResource($livro);

            return Services::retorno(Response::HTTP_OK, '', self::$texto_mensagem, $livro);
        }

        return Services::retorno(Response::HTTP_NOT_FOUND, 'nao_encontrado', self::$texto_mensagem);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $livro)
    {
        $erros = Services::validar($request, $this->getRegras());

        if (!empty($erros)) {
            return Services::retorno(Response::HTTP_INTERNAL_SERVER_ERROR, 'erro_alterar', self::$texto_mensagem, null, $erros);
        }

        $livro = Livro::with(array('autores', 'assuntos'))->find($livro);

        if ($livro){
            $livro->titulo = $request->titulo;
            $livro->editora = $request->editora;
            $livro->edicao = $request->edicao;
            $livro->ano_publicacao = $request->ano_publicacao;
            $livro->save();

            $livro = new LivroResource($livro);
            return Services::retorno(Response::HTTP_OK, 'alterado_sucesso', self::$texto_mensagem, $livro);
        }

        return Services::retorno(Response::HTTP_NOT_FOUND, 'nao_encontrado', self::$texto_mensagem);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($livro)
    {
        $livroAssunto = LivroAssunto::where('livro_id', $livro);
        $livroAssunto->delete();

        $livroAutor = LivroAutor::where('livro_id', $livro);
        $livroAutor->delete();

        $livro = Livro::find($livro);

        if ($livro){
            $livro->delete();

            return Services::retorno(Response::HTTP_OK, 'excluido_sucesso', self::$texto_mensagem);
        }

        return Services::retorno(Response::HTTP_NOT_FOUND, 'nao_encontrado', self::$texto_mensagem);
    }
}
