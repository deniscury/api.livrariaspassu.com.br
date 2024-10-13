Aqui está uma versão aprimorada e mais técnica do seu `README.md` para o projeto Livraria Spassu, em português:

---

# Livraria Spassu - Guia de Instalação

## Requisitos do Sistema

Para instalar e executar com sucesso a aplicação Livraria Spassu, certifique-se de que seu ambiente atenda aos seguintes requisitos:

-   **PHP**: Versão 8.3.12 ou superior
-   **Composer**: Gerenciador de dependências para PHP
-   **Configuração do php.ini**: Certifique-se de que as seguintes extensões estejam habilitadas:
    -   `curl`
    -   `ftp`
    -   `fileinfo`
    -   `intl`
    -   `mbstring`
    -   `exif`
    -   `mysqli`
    -   `pdo_mysql`
    -   `openssl`
    -   `zip`
-   **Diretório de Extensão**: Defina o diretório de extensão no seu arquivo `php.ini`:
    ```
    extension_dir = "ext"
    ```

## Passos de Instalação

Siga estes passos para configurar o projeto Livraria Spassu:

1. **Clonar o Repositório**:

    ```bash
    git clone <url-do-repositorio>
    ```

2. **Navegar até a Pasta Raiz do Projeto**:
   Certifique-se de que você está na pasta raiz do projeto clonado.

    ```bash
        cd <pasta-do-projeto>
    ```

3. **Configurar o Arquivo de Ambiente**:
   Renomeie o arquivo de exemplo de ambiente:

    ```bash
    mv .env.example .env
    ```

4. **Instalar Dependências**:
   Abra seu terminal ou prompt de comando e execute:

    ```bash
    composer install
    ```

5. **Alterar hosts**:
   Abra o arquivo hosts (C:\Windows\System32\drivers\etc\hosts) e adicione o DNS:

    ```bash
    127.0.0.1       api.livrariaspassu.local
    ```

6. **Executar a Aplicação**:
   Inicie o servidor de desenvolvimento local com:
    ```bash
    php artisan serve --host=api.livrariaspassu.local --port=8000
    ```

# Integração com as APIs

## Pré-requisitos

-   URL: http://api.livrariaspassu.local:8000/api

## Endpoints

### Assuntos

#### Listar todos

-   **Método:** GET
-   **Endpoint:** /assunto
-   **Resposta:**
    -   `status`: 200 - OK

```json
{
    "dados": [
        [
            {
                "id": 1,
                "descricao": "Mangá"
            },
            {
                "id": 2,
                "descricao": "Quadrinho"
            },
            {
                "id": 3,
                "descricao": "Drama"
            },
            {
                "id": 4,
                "descricao": "Aventura"
            },
            {
                "id": 6,
                "descricao": "Suspense"
            }
        ]
    ]
}
```

#### Quantidade de Registros

-   **Método:** GET
-   **Endpoint:** /assunto/quantidade-registros
-   **Resposta:**
    -   `status`: 200 - OK

```json
{
    "dados": {
        "registros": 9
    }
}
```

#### Buscar

-   **Método:** GET
-   **Endpoint:** /assunto/{$assunto}
-   **Resposta:**
    -   `status`: 200 - OK ou 404 - NOT FOUND

```json
{
    "dados": {
        "id": 5,
        "descricao": "Terror",
        "livros": [[]]
    }
}
```

```json
{
    "mensagem": "Assunto não encontrado"
}
```

#### Cadastrar

-   **Método:** POST
-   **Endpoint:** /assunto
-   **Parâmetros:**
    -   `descricao`: Descrição do assunto
-   **Resposta:**
    -   `status`: 201 - CREATED ou 500 - INTERNAL SERVER ERROR

```json
{
    "mensagem": "Assunto cadastrado com sucesso",
    "dados": {
        "id": 9,
        "descricao": "Comédia"
    }
}
```

```json
{
    "mensagem": "Erro ao cadastrar assunto",
    "erros": {
        "{campo}": ["{mensagem_erro}"]
    }
}
```

#### Alterar

-   **Método:** PATCH
-   **Endpoint:** /assunto/{assunto}
-   **Parâmetros:**
    -   `descricao`: Descrição do assunto
-   **Resposta:**
    -   `status`: 200 - OK ou 500 - INTERNAL SERVER ERROR

```json
{
    "mensagem": "Assunto alterado com sucesso",
    "dados": {
        "id": 8,
        "descricao": "Poesia"
    }
}
```

```json
{
    "mensagem": "Erro ao alterar assunto",
    "erros": {
        "{campo}": ["{mensagem_erro}"]
    }
}
```

#### Excluir

-   **Método:** DELETE
-   **Endpoint:** /assunto/{assunto}
-   **Resposta:**
    -   `status`: 200 - OK ou 404 - NOT FOUND

```json
{
    "mensagem": "Assunto excluído com sucesso"
}
```

```json
{
    "mensagem": "Assunto não encontrado"
}
```

### Autores

#### Listar todos

-   **Método:** GET
-   **Endpoint:** /autor
-   **Resposta:**
    -   `status`: 200 - OK

```json
{
    "dados": [
        [
            {
                "id": 2,
                "nome": "J. K. Rowlling"
            },
            {
                "id": 3,
                "nome": "Rick Riordan"
            },
            {
                "id": 4,
                "nome": "Masashi Kishimoto"
            }
        ]
    ]
}
```

#### Livros por autores

-   **Método:** POST
-   **Endpoint:** /autor/livros
-   **Resposta:**
    -   `status`: 200 - OK

```json
{
    "dados": [
        [
            {
                "id": 22,
                "nome": "Eiichiro Oda",
                "livros": [
                    [
                        {
                            "id": 1,
                            "titulo": "One Piece",
                            "editora": "Panini Comics",
                            "edicao": 1,
                            "ano_publicacao": "1997",
                            "valor": "15,00",
                            "assuntos": [
                                [
                                    {
                                        "id": 1,
                                        "descricao": "Mangás"
                                    },
                                    {
                                        "id": 2,
                                        "descricao": "Quadrinho"
                                    },
                                    {
                                        "id": 4,
                                        "descricao": "Aventura"
                                    }
                                ]
                            ]
                        }
                    ]
                ]
            },
            {
                "id": 2,
                "nome": "J. K. Rowlling",
                "livros": [
                    [
                        {
                            "id": 4,
                            "titulo": "Harry Potter e a pedra filosofal",
                            "editora": "Bloomsbury Publishing",
                            "edicao": 1,
                            "ano_publicacao": "1997",
                            "valor": "50,00",
                            "assuntos": [
                                [
                                    {
                                        "id": 4,
                                        "descricao": "Aventura"
                                    }
                                ]
                            ]
                        }
                    ]
                ]
            }
        ]
    ]
}
```

#### Quantidade de Registros

-   **Método:** GET
-   **Endpoint:** /autor/quantidade-registros
-   **Resposta:**
    -   `status`: 200 - OK

```json
{
    "dados": {
        "registros": 5
    }
}
```

#### Buscar

-   **Método:** GET
-   **Endpoint:** /autor/{$autor}
-   **Resposta:**
    -   `status`: 200 - OK ou 404 - NOT FOUND

```json
{
    "dados": {
        "id": 22,
        "nome": "Eiichiro Oda",
        "livros": [[]]
    }
}
```

```json
{
    "mensagem": "Autor(a) não encontrado(a)"
}
```

#### Cadastrar

-   **Método:** POST
-   **Endpoint:** /autor
-   **Parâmetros:**
    -   `nome`: Nome do autor
-   **Resposta:**
    -   `status`: 201 - CREATED ou 500 - INTERNAL SERVER ERROR

```json
{
    "mensagem": "Autor(a) cadastrado(a) com sucesso",
    "dados": {
        "id": 25,
        "nome": "Cecília Meireles"
    }
}
```

```json
{
    "mensagem": "Erro ao cadastrar autor(a)",
    "erros": {
        "{campo}": ["{mensagem_erro}"]
    }
}
```

#### Alterar

-   **Método:** PATCH
-   **Endpoint:** /autor/{autor}
-   **Parâmetros:**
    -   `nome`: Nome do autor
-   **Resposta:**
    -   `status`: 200 - OK ou 500 - INTERNAL SERVER ERROR

```json
{
    "mensagem": "Autor(a) alterado(a) com sucesso",
    "dados": {
        "id": 5,
        "nome": "Gege Akutami"
    }
}
```

```json
{
    "mensagem": "Erro ao alterar autor(a)",
    "erros": {
        "{campo}": ["{mensagem_erro}"]
    }
}
```

#### Excluir

-   **Método:** DELETE
-   **Endpoint:** /autor/{autor}
-   **Resposta:**
    -   `status`: 200 - OK ou 404 - NOT FOUND

```json
{
    "mensagem": "Autor(a) excluído(a) com sucesso"
}
```

```json
{
    "mensagem": "Autor(a) não encontrado(a)"
}
```

### Livros

#### Listar todos

-   **Método:** GET
-   **Endpoint:** /livro
-   **Resposta:**
    -   `status`: 200 - OK

```json
{
    "dados": [
        [
            {
                "id": 1,
                "titulo": "One Piece",
                "editora": "Panini Comics",
                "edicao": 1,
                "ano_publicacao": "1997",
                "valor": "0,00"
            },
            {
                "id": 2,
                "titulo": "As vantagens de ser invísivel",
                "editora": "Rocco",
                "edicao": 1,
                "ano_publicacao": "2007",
                "valor": "0,00"
            },
            {
                "id": 3,
                "titulo": "As vantagens de ser invísivel",
                "editora": "Rocco",
                "edicao": 1,
                "ano_publicacao": "2007",
                "valor": "0,00"
            }
        ]
    ]
}
```

#### Quantidade de Registros

-   **Método:** GET
-   **Endpoint:** /livro/quantidade-registros
-   **Resposta:**
    -   `status`: 200 - OK

```json
{
    "dados": {
        "registros": 30
    }
}
```

#### Buscar

-   **Método:** GET
-   **Endpoint:** /livro/{$livro}
-   **Resposta:**
    -   `status`: 200 - OK ou 404 - NOT FOUND

```json
{
    "dados": {
        "id": 1,
        "titulo": "One Piece",
        "editora": "Panini Comics",
        "edicao": 1,
        "ano_publicacao": "1997",
        "valor": "0,00",
        "autores": [[]],
        "assuntos": [[]]
    }
}
```

```json
{
    "mensagem": "Livro não encontrado"
}
```

#### Cadastrar

-   **Método:** POST
-   **Endpoint:** /livro
-   **Parâmetros:**
    -   `titulo`: Título do livro
    -   `editora`: Editora
    -   `edicao`: Número da edição
    -   `ano_publicacao`: Ano de publicação do livro
    -   `valor`: Valor do livro
-   **Resposta:**
    -   `status`: 201 - CREATED ou 500 - INTERNAL SERVER ERROR

```json
{
    "mensagem": "Livro cadastrado com sucesso",
    "dados": {
        "id": 5,
        "titulo": "Harry Potter e a camâra secreta",
        "editora": "Bloomsbury Publishing",
        "edicao": 2,
        "ano_publicacao": 1998,
        "valor": "0,00"
    }
}
```

```json
{
    "mensagem": "Erro ao cadastrar livro",
    "erros": {
        "{campo}": ["{mensagem_erro}"]
    }
}
```

#### Alterar

-   **Método:** PATCH
-   **Endpoint:** /livro/{livro}
-   **Parâmetros:**
    -   `titulo`: Título do livro
    -   `editora`: Editora
    -   `edicao`: Número da edição
    -   `ano_publicacao`: Ano de publicação do livro
    -   `valor`: Valor do livro
-   **Resposta:**
    -   `status`: 200 - OK ou 500 - INTERNAL SERVER ERROR

```json
{
    "mensagem": "Livro alterado com sucesso",
    "dados": {
        "id": 6,
        "titulo": "Harry Potter e o prisioneiro de Askaban",
        "editora": "Bloomsbury Publishing",
        "edicao": 3,
        "ano_publicacao": 1999,
        "valor": "0,00",
        "autores": [[]],
        "assuntos": [[]]
    }
}
```

```json
{
    "mensagem": "Erro ao alterar livro",
    "erros": {
        "{campo}": ["{mensagem_erro}"]
    }
}
```

#### Excluir

-   **Método:** DELETE
-   **Endpoint:** /livro/{livro}
-   **Resposta:**
    -   `status`: 200 - OK ou 404 - NOT FOUND

```json
{
    "mensagem": "Livro excluído com sucesso"
}
```

```json
{
    "mensagem": "Livro não encontrado"
}
```

### Vínculo Livro Assunto

#### Listar todos

-   **Método:** GET
-   **Endpoint:** /livro-assunto
-   **Resposta:**
    -   `status`: 200 - OK

```json
{
    "dados": [
        [
            {
                "livro_id": 1,
                "assunto_id": 1,
                "livro": {
                    "id": 1,
                    "titulo": "One Piece",
                    "editora": "Panini Comics",
                    "edicao": 1,
                    "ano_publicacao": "1997"
                },
                "assunto": {
                    "id": 1,
                    "descricao": "Mangá"
                }
            },
            {
                "livro_id": 1,
                "assunto_id": 4,
                "livro": {
                    "id": 1,
                    "titulo": "One Piece",
                    "editora": "Panini Comics",
                    "edicao": 1,
                    "ano_publicacao": "1997"
                },
                "assunto": {
                    "id": 4,
                    "descricao": "Aventura"
                }
            },
            {
                "livro_id": 2,
                "assunto_id": 3,
                "livro": {
                    "id": 2,
                    "titulo": "As vantagens de ser invísivel",
                    "editora": "Rocco",
                    "edicao": 1,
                    "ano_publicacao": "2007"
                },
                "assunto": {
                    "id": 3,
                    "descricao": "Drama"
                }
            }
        ]
    ]
}
```

#### Buscar

-   **Método:** GET
-   **Endpoint:** /livro-assunto/livro/{livro}/assunto/{assunto}
-   **Resposta:**
    -   `status`: 200 - OK ou 404 - NOT FOUND

```json
{
    "dados": {
        "livro_id": 1,
        "assunto_id": 1,
        "livro": {
            "id": 1,
            "titulo": "One Piece",
            "editora": "Panini Comics",
            "edicao": 1,
            "ano_publicacao": "1997"
        },
        "assunto": {
            "id": 1,
            "descricao": "Mangá"
        }
    }
}
```

```json
{
    "mensagem": "Vínculo não encontrado"
}
```

#### Cadastrar

-   **Método:** POST
-   **Endpoint:** /livro-assunto
-   **Parâmetros:**
    -   `livro_id`: ID do livro
    -   `assunto_id`: ID do assunto
-   **Resposta:**
    -   `status`: 201 - CREATED ou 500 - INTERNAL SERVER ERROR

```json
{
    "mensagem": "Vínculo cadastrado com sucesso",
    "dados": {
        "livro_id": 4,
        "assunto_id": 4
    }
}
```

```json
{
    "mensagem": "Erro ao cadastrar vínculo",
    "erros": {
        "{campo}": ["{mensagem_erro}"]
    }
}
```

#### Excluir

-   **Método:** DELETE
-   **Endpoint:** /livro-assunto/livro/{livro}/assunto/{assunto}
-   **Resposta:**
    -   `status`: 200 - OK ou 404 - NOT FOUND

```json
{
    "mensagem": "Vínculo excluído com sucesso"
}
```

```json
{
    "mensagem": "Vínculo não encontrado"
}
```

### Vínculo Livro Autor

#### Listar todos

-   **Método:** GET
-   **Endpoint:** /livro-autor
-   **Resposta:**
    -   `status`: 200 - OK

```json
{
    "dados": [
        [
            {
                "livro_id": 1,
                "autor_id": 22,
                "livro": {
                    "id": 1,
                    "titulo": "One Piece",
                    "editora": "Panini Comics",
                    "edicao": 1,
                    "ano_publicacao": "1997"
                },
                "autor": {
                    "id": 22,
                    "nome": "Eiichiro Oda"
                }
            }
        ]
    ]
}
```

#### Buscar

-   **Método:** GET
-   **Endpoint:** /livro-autor/livro/{livro}/autor/{autor}
-   **Resposta:**
    -   `status`: 200 - OK ou 404 - NOT FOUND

```json
{
    "dados": {
        "livro_id": 1,
        "autor_id": 22,
        "livro": {
            "id": 1,
            "titulo": "One Piece",
            "editora": "Panini Comics",
            "edicao": 1,
            "ano_publicacao": "1997"
        },
        "autor": {
            "id": 22,
            "nome": "Eiichiro Oda"
        }
    }
}
```

```json
{
    "mensagem": "Vínculo não encontrado"
}
```

#### Cadastrar

-   **Método:** POST
-   **Endpoint:** /livro-autor
-   **Parâmetros:**
    -   `livro_id`: ID do livro
    -   `autor_id`: ID do autor
-   **Resposta:**
    -   `status`: 201 - CREATED ou 500 - INTERNAL SERVER ERROR

```json
{
    "mensagem": "Vínculo cadastrado com sucesso",
    "dados": {
        "livro_id": 3,
        "autor_id": 10
    }
}
```

```json
{
    "mensagem": "Erro ao cadastrar vínculo",
    "erros": {
        "{campo}": ["{mensagem_erro}"]
    }
}
```

#### Excluir

-   **Método:** DELETE
-   **Endpoint:** /livro-autor/livro/{livro}/autor/{autor}
-   **Resposta:**
    -   `status`: 200 - OK ou 404 - NOT FOUND

```json
{
    "mensagem": "Vínculo excluído com sucesso"
}
```

```json
{
    "mensagem": "Vínculo não encontrado"
}
```

## Observações Adicionais

-   Certifique-se de ter as permissões necessárias para os diretórios e arquivos dentro do projeto.
-   Se você encontrar algum problema, verifique suas instalações do PHP e Composer, e assegure-se de que todas as extensões necessárias estão habilitadas.
-   Para mais assistência, consulte a documentação oficial do [Laravel](https://laravel.com/docs).

---

Essa versão é estruturada, fornece comandos claros e inclui notas adicionais para melhor clareza e usabilidade.

```

```
