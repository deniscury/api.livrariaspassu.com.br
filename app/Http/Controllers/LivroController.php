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
            'ano_publicacao' => 'required|min:4|max:4',
            'valor' => 'required|numeric|between:0.01,99999999999.99'
        );

        $this->setRegras($regras);
    }
    
    /**
     * Lista todos os registros da tabela.
     */
    public function index()
    {
        $livros = new LivrosCollection(Livro::all());

        return Services::retorno(Response::HTTP_OK, '', self::$texto_mensagem, $livros);
    }

    /**
     * Conta os registros da tabela.
     */
    public function quantidadeRegistros()
    {
        $livros = Livro::count();

        $qtdLivros = array('registros' => $livros);

        return Services::retorno(Response::HTTP_OK, '', self::$texto_mensagem, $qtdLivros);
    }

    /**
     * Cadastrar livro.
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
     * Lista um registro específico.
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
     * Altera um registro específico.
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
            $livro->valor = $request->valor;
            $livro->save();

            $livro = new LivroResource($livro);
            return Services::retorno(Response::HTTP_OK, 'alterado_sucesso', self::$texto_mensagem, $livro);
        }

        return Services::retorno(Response::HTTP_NOT_FOUND, 'nao_encontrado', self::$texto_mensagem);
    }

    /**
     * Exclui um registro específico.
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
