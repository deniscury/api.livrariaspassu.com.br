<?php
namespace App\Http\Controllers;

use App\Models\LivroAutor;

use App\Http\Resources\LivroAutorResource;
use App\Http\Resources\LivroAutoresCollection;
use App\Http\Services;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LivroAutorController extends Controller
{
    protected static $texto_mensagem = array('vínculo');

    public function __construct()
    {
        $regras = array(
            'livro_id' => 'required|exists:livros,id',
            'autor_id' => 'required|exists:autores,id',
        );

        $this->setRegras($regras);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livroAutores = new LivroAutoresCollection(LivroAutor::with(array('livro', 'autor'))->get());

        return Services::retorno(Response::HTTP_OK, '', self::$texto_mensagem, $livroAutores);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $regras = $this->getRegras();

        $regras['livro_id'] .= '|unique:livro_autores,livro_id,NULL,id,autor_id,' . $request->autor_id;
        $regras['autor_id'] .= '|unique:livro_autores,autor_id,NULL,id,livro_id,' . $request->livro_id;

        $erros = Services::validar($request, $regras);

        if (!empty($erros)) {
            return Services::retorno(Response::HTTP_INTERNAL_SERVER_ERROR, 'erro_cadastro', self::$texto_mensagem, null, $erros);
        }

        $livroAutor = LivroAutor::create($request->all());

        if($livroAutor){
            $livroAutor = new LivroAutorResource($livroAutor);
            return Services::retorno(Response::HTTP_CREATED, 'cadastrado_sucesso', self::$texto_mensagem, $livroAutor);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($livro, $autor)
    {
        $livroAutor = LivroAutor::with(array('livro', 'autor'))->where('livro_id', $livro)->where('autor_id', $autor)->first();

        if ($livroAutor){
            $livroAutor = new LivroAutorResource($livroAutor);

            return Services::retorno(Response::HTTP_OK, '', self::$texto_mensagem, $livroAutor);
        }
        return Services::retorno(Response::HTTP_NOT_FOUND, 'nao_encontrado', self::$texto_mensagem);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($livro, $autor)
    {
        $livroAutor = LivroAutor::where('livro_id', $livro)->where('autor_id', $autor);

        if ($livroAutor){
            $livroAutor->delete();

            return Services::retorno(Response::HTTP_OK, 'excluido_sucesso', self::$texto_mensagem);
        }

        return Services::retorno(Response::HTTP_NOT_FOUND, 'nao_encontrado', self::$texto_mensagem);
    }
}
