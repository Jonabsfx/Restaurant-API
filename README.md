### Instruções para testar o projeto

```bash
# Clone o projeto
$ git clone https://github.com/Jonabsfx/restaurant-api.git

# Vá para a pasta do projeto
$ cd restaurant-api

# Baixe todas as dependências do projeto
$ composer install

# Comece a aplicação Laravel
$ php artisan key:generate

# Edite os campos abaixo no seu arquivo .env para configurar a base de dados.

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=desafio-api
DB_USERNAME=root
DB_PASSWORD=admin

# Baixe a imagem Docker
$ docker push jonabsfx/api-restaurant:latest

# Faça as migrations
$ php artisan migrate

# O projeto já tem algumas seeders preparadas. Para utilizá-las:
$ php artisan db:seed --class=DatabaseSeeder

# Rodar os testes de integração
$ php artisan test

# Acesse servidor API na porta local 8000

Obs: Para testar as rotas protegidas, a senha padrão é 1918, que foi não criptografada por motivos de praticidade do teste.