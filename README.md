## Livraria Spassu

# Requisitos para instalação

-   PHP 8.3.12
-   Composer
-   php.ini
    -   Extension List
        -   curl
        -   ftp
        -   fileinfo
        -   intl
        -   mbstring
        -   exif
        -   mysqli
        -   pdo_mysql
        -   openssl
        -   zip
    -   extension_dir = "ext"

# Passo a passo

-   Clonar projeto
-   Navegar até a pasta raiz e execute as seguintes ações:
    -   Renomear arquivo .env.example para .env
    -   Abra o terminal/Prompt de comando
    -   Execute o comando composer install
    -   Execute o comando php artisan key:generate
    -   Execute o comando php artisan serve
