### Instruções para testar o projeto

```bash
# Clone este repositório
$ git clone https://github.com/Jonabsfx/desafio-multiplier-back-end.git

# Vá para a pasta do projeto
$ cd desafio-multiplier-back-end

# Instale as dependências
$ composer install

# Edite os campos abaixo no seu arquivo .env para configurar a base de dados.

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=desafio-api
DB_USERNAME=root
DB_PASSWORD=admin

# Criar migrations
$ php artisan migrate

# Criar seeders
$ php artisan db:seed --class=DatabaseSeeder

# Rodar os testes de integração
$ php artisan test

Obs: Para testar as rotas protegidas, a senha padrão é 1918, que foi não criptografada por motivos de praticidade do teste.