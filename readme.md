# SIMPLES API DE LIVROS

Aplicação simples de CRUD de Livros, Autores e Disciplinas utilizando técnicas que podem ser utilizadas com CI/CD
para gerencimento de ambientes com o uso de:


## Acessos:

Disponivel no Heroku com o seguinte Link:

http://api-library-testcase.herokuapp.com/api/documentation e coverage report em:

http://api-library-testcase.herokuapp.com/coverage-report


## Especificações Técnicas

Esta aplicação conta com as seguintes especificações abaixo: 

| Ferramenta | Versão |
| --- | --- |
| Docker | 1.13.1 |
| Docker Compose | 1.22.0 |
| Nginx | 1.15.2 |
| PHP | 7.2.11 |
| Mariabd | 10.3.8 |
| Redis | 5.0.0 |
| Sqlite | 3.16.2 |
| Laravel Framework | 5.7.* |
| Swagger | 2.*.* |

A aplicação é separada pelos seguintes conteineres

| Service | Image |
| --- | --- |
| mysql | mariadb:latest |
| redis | redis:alpine |
| php | laravel:php-fpm |
| web (nginx) | nginx:alpine |

## Requisitos
    - Docker
    - Docker Compose

## Procedimentos de Instalação
    Procedimentos de Instação da aplicação para uso local

1- Baixar repositório 
    - git clone https://github.com/brunocaramelo/library_api.git

2 - Verificar se as portas 80 e 3306 estão ocupadas.

3 - Entrar no diretório base da aplicação e executar os comandos abaixo:
    
    1 - sudo docker-compose up -d;

    2 - sudo docker exec -t php-library php /var/www/html/artisan migrate;

    3 - sudo docker exec -t php-library php /var/www/html/artisan db:seed;

    4 - sudo docker exec -t php-library php /var/www/html/artisan key:generate;

    5 - sudo docker exec -t php-library phpunit;

    1 -  para que as imagens sejam armazenandas e executadas e subir as instancias
    
    2 -  para que o framework gere e aplique o mapeamento para a base de dados (SQL) podendo ser Mysql, PostGres , Oracle , SQL Serve ou SQLITE por exemplo
    
    3 -  para que o framework  aplique mudanças nos dados da base, no caso inserção de um primeiro usuário.
    
    4 - para que o framework execute a suite de testes.
        - testes de API  
        - testes de unidade

### Observações:

Caso queira fazer um teste local com o uso do Swagger será necessario alterar o seguinte arquivo
    - /application/storage/api-docs/api-docs.json
    Linha 12: "host": 
        DE : "api-library-testcase.herokuapp.com/api",
        PARA : "localhost/api",

## Pós Instalação

Após instalar o endereço de acesso é:

- http://localhost/api/documentation


## Changelog

### v1.5.0
#### Implantação no Heroku
- Correções de bugs
- Ajustes no read.me
- Ajustes no schema do Swagger
- Disponibilização da aplicação em : http://api-library-testcase.herokuapp.com/api/documentation

### v1.4.0
#### Instalação do Swagger e ajustes finais
- Ajustes em Books
- Instalação do Swagger
- Ajustes de CI/CD

### v1.3.0
#### Módulo de Livros
- Ajustes de Disciplinas e Autores
- Finalização da cobertura de testes
- Módulo de Livos

### v1.2.0
#### Módulos de Disciplina e Autores
- Adição de Módulos de Disciplinas e Autores
- Testes Unitários e de API
- Adicionado Coverage Report
- Seeder de teste
- API pública com módulos de Disciplina e Autores

### 1.1.0
#### Migrations e Seeders
- Estruturação do schema
- Execução da migração para a base de dados
- Criação e estruturação
- Execução dos Seeders com base no JSON exposto (storage/data_import/data-origin.json)

### v1.0.0
#### Framework e Deploy

- Framework Laravel 5.7
- Docker utilizando versão 1.13
- Docker compose versão 1.22
- Contexto de contêiners
    - PHP + PHP-FPM
    - Nginx
    - Mariadb
    - Redis
