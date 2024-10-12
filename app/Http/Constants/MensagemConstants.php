<?php

namespace App\Http\Constants;

class MensagemConstants
{
    const MENSAGENS_VALIDACAO = array(
        'required' => 'O campo :attribute é obrigatório.',
        'min' => 'O campo :attribute deve conter no mínimo :min caracteres.',
        'max' => 'O campo :attribute deve conter no máximo :max caracteres.',
        'integer' => 'O campo :attribute deve ser um número inteiro.',
        'decimal' => 'O campo :attribute deve ser um número decimal.',
        'numeric' => 'O campo :attribute deve ser um número.',
        'exists' => 'O :attribute :input é inválido.',
        'unique' => 'Identificamos que o registro já existe.'
    );

    const MENSAGENS_RETORNO = array(
        'nao_encontradoa' => '%s não encontrado(a)',
        'nao_encontrado' => '%s não encontrado',
        'nao_encontrada' => '%s não encontrada',

        'cadastradoa_sucesso' => '%s cadastrado(a) com sucesso',
        'cadastrado_sucesso' => '%s cadastrado com sucesso',
        'cadastrada_sucesso' => '%s cadastrada com sucesso',

        'alteradoa_sucesso' => '%s alterado(a) com sucesso',
        'alterado_sucesso' => '%s alterado com sucesso',
        'alterada_sucesso' => '%s alterada com sucesso',

        'excluidoa_sucesso' => '%s excluído(a) com sucesso',
        'excluido_sucesso' => '%s excluído com sucesso',
        'excluida_sucesso' => '%s excluída com sucesso',

        'erro_cadastro' => 'Erro ao cadastrar %s',
        'erro_alterar' => 'Erro ao alterar %s',
        'erro_excluir' => 'Erro ao excluir %s'
    );

    public static function getMensagensValidacao(){
        return self::MENSAGENS_VALIDACAO;
    }

    public static function getMensagensRetorno(){
        return self::MENSAGENS_RETORNO;
    }
}
