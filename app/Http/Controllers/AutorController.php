<?php
namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\LivroAutor;

use App\Http\Resources\AutoresCollection;
use App\Http\Resources\AutorResource;
use App\Http\Services;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AutorController extends Controller
{
    protected static $texto_mensagem = array('autor(a)');

    public function __construct()
    {
        $regras = array(
            'nome' => 'required|min:3|max:40'
        );

        $this->setRegras($regras);
    }
    
    /**
     * Lista todos os registros da tabela.
     */
    public function index()
    {
        $autores = new AutoresCollection(Autor::all());

        return Services::retorno(Response::HTTP_OK, '', self::$texto_mensagem, $autores);
    }

    /**
     * Conta os registros da tabela.
     */
    public function quantidadeRegistros()
    {
        $autores = Autor::count();

        $qtdAutores = array('registros' => $autores);

        return Services::retorno(Response::HTTP_OK, '', self::$texto_mensagem, $qtdAutores);
    }

    /**
     * Cadastrar autor(a).
     */
    public function store(Request $request)
    {
        $erros = Services::validar($request, $this->getRegras());

        if (!empty($erros)) {
            return Services::retorno(Response::HTTP_INTERNAL_SERVER_ERROR, 'erro_cadastro', self::$texto_mensagem, null, $erros);
        }

        $autor = Autor::create($request->all());

        if($autor){
            $autor = new AutorResource($autor);
            return Services::retorno(Response::HTTP_CREATED, 'cadastradoa_sucesso', self::$texto_mensagem, $autor);
        }
    }

    /**
     * Lista um registro específico.
     */
    public function show($autor)
    {
        $autor = Autor::with(array('livros'))->find($autor);

        if ($autor){
            $autor = new AutorResource($autor);

            return Services::retorno(Response::HTTP_OK, '', self::$texto_mensagem, $autor);
        }

        return Services::retorno(Response::HTTP_NOT_FOUND, 'nao_encontradoa', self::$texto_mensagem);
    }
    
    /**
     * Altera um registro específico.
     */
    public function update(Request $request, $autor)
    {
        $erros = Services::validar($request, $this->getRegras());

        if (!empty($erros)) {
            return Services::retorno(Response::HTTP_INTERNAL_SERVER_ERROR, 'erro_alterar', self::$texto_mensagem, null, $erros);
        }

        $autor = Autor::find($autor);

        if ($autor){
            $autor->nome = $request->nome;
            $autor->save();

            $autor = new AutorResource($autor);
            return Services::retorno(Response::HTTP_OK, 'alteradoa_sucesso', self::$texto_mensagem, $autor);
        }

        return Services::retorno(Response::HTTP_NOT_FOUND, 'nao_encontradoa', self::$texto_mensagem);
    }

    /**
     * Exclui um registro específico.
     */
    public function destroy($autor)
    {
        $livroAutor = LivroAutor::where('autor_id', $autor);
        $livroAutor->delete();

        $autor = Autor::find($autor);

        if ($autor){
            $autor->delete();

            return Services::retorno(Response::HTTP_OK, 'excluidoa_sucesso', self::$texto_mensagem);
        }

        return Services::retorno(Response::HTTP_NOT_FOUND, 'nao_encontradoa', self::$texto_mensagem);
    }
}
