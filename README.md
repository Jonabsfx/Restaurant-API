# Instruções para testar o projeto

```bash
# Clone o projeto
$ git clone https://github.com/Jonabsfx/restaurant-api.git restaurant-api

# Vá para a pasta do projeto
$ cd restaurant-api

# Crie uma cópia do arquivo de configurações
$ cp .env.example .env

# Edite os campos abaixo no seu arquivo .env para configurar a base de dados.

APP_NAME=Restaurant-API
APP_URL=http://localhost:8081

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=restaurant_db
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

# Suba os containers do projeto
$ docker-compose up -d

# Acesse o container do projeto
$ docker-compose exec app bash

# Instale as dependências do projeto
$ composer install

# Gere a chave do projeto
$ php artisan key:generate

# O projeto já tem algumas seeders preparadas. Para utilizá-las:
$ php artisan db:seed --class=DatabaseSeeder

# Rodar os testes de integração
$ php artisan test

# Acesse servidor API na porta local 8081

Obs: Para testar as rotas protegidas, a senha padrão é 1918, que foi não criptografada por motivos de praticidade do teste.