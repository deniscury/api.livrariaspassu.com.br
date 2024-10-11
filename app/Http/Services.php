<?php

namespace App\Http;

use App\Http\Constants\MensagemConstants;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class Services
{
    protected static $mensagemValidacao = MensagemConstants::MENSAGENS_VALIDACAO;
    protected static $mensagemRetorno = MensagemConstants::MENSAGENS_RETORNO;

    public static function validar(Request $request, array $regras){
        $erros = array();
        $validar = Validator::make($request->all(), $regras, self::$mensagemValidacao);

        if($validar->fails()){
            $erros = $validar->errors();
        }

        return $erros;
    }
    
    public static function retorno(int $status = 200, string $indexMensagem = '', array $texto_mensagem = array(), $dados = null, MessageBag $erros = null){
        if (isset(self::$mensagemRetorno[$indexMensagem])){
            $retorno['mensagem'] = ucfirst(vsprintf(self::$mensagemRetorno[$indexMensagem], array_values($texto_mensagem)));
        }

        if(!is_null($dados)){
            $retorno['dados'] = $dados;
        }

        if(!is_null($erros)){
            $retorno['erros'] = $erros;
        }

        return response()->json($retorno, $status);
    }    

    /**
     * Get the value of mensagemValidacao
     */ 
    public function getMensagemValidacao()
    {
        return $this->mensagemValidacao;
    }

    /**
     * Set the value of mensagemValidacao
     */ 
    public function setMensagemValidacao($mensagemValidacao)
    {
        $this->mensagemValidacao = $mensagemValidacao;

        return $this;
    }

    /**
     * Get the value of mensagemRetorno
     */ 
    public function getMensagemRetorno()
    {
        return $this->mensagemRetorno;
    }

    /**
     * Set the value of mensagemRetorno
     */ 
    public function setMensagemRetorno($mensagemRetorno)
    {
        $this->mensagemRetorno = $mensagemRetorno;
    }
}
