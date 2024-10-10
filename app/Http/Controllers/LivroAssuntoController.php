<?php
namespace App\Http\Controllers;

use App\Models\LivroAssunto;

use App\Http\Resources\LivroAssuntoResource;
use App\Http\Resources\LivroAssuntosCollection;
use App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class LivroAssuntoController extends Controller
{
    protected static $texto_mensagem = array('vínculo');

    public function __construct()
    {
        $regras = array(
            'livro_id' => 'required|exists:livros,id',
            'assunto_id' => 'required|exists:assuntos,id',
        );

        $this->setRegras($regras);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livroAssuntos = new LivroAssuntosCollection(LivroAssunto::with(array('livro', 'assunto'))->get());

        return $livroAssuntos;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $regras = $this->getRegras();

        $regras['livro_id'] .= '|unique:livro_assuntos,livro_id,NULL,id,assunto_id,' . $request->assunto_id;
        $regras['assunto_id'] .= '|unique:livro_assuntos,assunto_id,NULL,id,livro_id,' . $request->livro_id;

        $erros = Services::validar($request, $regras);

        if (!empty($erros)) {
            return Services::retorno(Response::HTTP_INTERNAL_SERVER_ERROR, 'erro_cadastro', self::$texto_mensagem, null, $erros);
        }

        $livroAssunto = LivroAssunto::create($request->all());

        if($livroAssunto){
            $livroAssunto = new LivroAssuntosCollection(array($livroAssunto));
            return Services::retorno(Response::HTTP_CREATED, 'cadastrado_sucesso', self::$texto_mensagem, $livroAssunto);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($livro, $assunto)
    {
        $livroAssunto = LivroAssunto::with(array('livro', 'assunto'))->where('livro_id', $livro)->where('assunto_id', $assunto)->get();

        if ($livroAssunto){
            return new LivroAssuntosCollection($livroAssunto);
        }

        return Services::retorno(Response::HTTP_NOT_FOUND, 'nao_encontrado', self::$texto_mensagem);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($livro, $assunto)
    {
        $livroAssunto = LivroAssunto::where('livro_id', $livro)->where('assunto_id', $assunto);

        if ($livroAssunto){
            $livroAssunto->delete();

            return Services::retorno(Response::HTTP_OK, 'excluido_sucesso', self::$texto_mensagem);
        }

        return Services::retorno(Response::HTTP_NOT_FOUND, 'nao_encontrado', self::$texto_mensagem);
    }
}
