<?php
namespace App\Http\Controllers;

use App\Models\Assunto;
use App\Models\LivroAssunto;

use App\Http\Resources\AssuntoResource;
use App\Http\Resources\AssuntosCollection;
use App\Http\Services;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssuntoController extends Controller
{
    protected static $texto_mensagem = array('assunto');

    public function __construct()
    {
        $regras = array(
            'descricao' => 'required|min:3|max:20'
        );

        $this->setRegras($regras);
    }
    
    /**
     * Lista todos os registros da tabela.
     */
    public function index()
    {
        $assuntos = new AssuntosCollection(Assunto::all());

        return Services::retorno(Response::HTTP_OK, '', self::$texto_mensagem, $assuntos);
    }

    /**
     * Conta os registros da tabela.
     */
    public function quantidadeRegistros()
    {
        $assuntos = Assunto::count();

        $qtdAssuntos = array('registros' => $assuntos);

        return Services::retorno(Response::HTTP_OK, '', self::$texto_mensagem, $qtdAssuntos);
    }

    /**
     * Cadastrar assunto.
     */
    public function store(Request $request)
    {
        $erros = Services::validar($request, $this->getRegras());

        if (!empty($erros)) {
            return Services::retorno(Response::HTTP_INTERNAL_SERVER_ERROR, 'erro_cadastro', self::$texto_mensagem, null, $erros);
        }

        $assunto = Assunto::create($request->all());

        if($assunto){
            $assunto = new AssuntoResource($assunto);
            return Services::retorno(Response::HTTP_CREATED, 'cadastrado_sucesso', self::$texto_mensagem, $assunto);
        }
    }

    /**
     * Lista um registro específico.
     */
    public function show($assunto)
    {
        $assunto = Assunto::with(array('livros'))->find($assunto);

        if ($assunto){
            $assunto = new AssuntoResource($assunto);

            return Services::retorno(Response::HTTP_OK, '', self::$texto_mensagem, $assunto);
        }

        return Services::retorno(Response::HTTP_NOT_FOUND, 'nao_encontrado', self::$texto_mensagem);
    }
    
    /**
     * Altera um registro específico.
     */
    public function update(Request $request, $assunto)
    {
        $erros = Services::validar($request, $this->getRegras());

        if (!empty($erros)) {
            return Services::retorno(Response::HTTP_INTERNAL_SERVER_ERROR, 'erro_alterar', self::$texto_mensagem, null, $erros);
        }

        $assunto = Assunto::find($assunto);

        if ($assunto){
            $assunto->descricao = $request->descricao;
            $assunto->save();

            $assunto = new AssuntoResource($assunto);
            return Services::retorno(Response::HTTP_OK, 'alterado_sucesso', self::$texto_mensagem, $assunto);
        }

        return Services::retorno(Response::HTTP_NOT_FOUND, 'nao_encontrado', self::$texto_mensagem);
    }

    /**
     * Exclui um registro específico.
     */
    public function destroy($assunto)
    {
        $livroAssunto = LivroAssunto::where('assunto_id', $assunto);
        $livroAssunto->delete();

        $assunto = Assunto::find($assunto);

        if ($assunto){
            $assunto->delete();

            return Services::retorno(Response::HTTP_OK, 'excluido_sucesso', self::$texto_mensagem);
        }

        return Services::retorno(Response::HTTP_NOT_FOUND, 'nao_encontrado', self::$texto_mensagem);
    }
}
