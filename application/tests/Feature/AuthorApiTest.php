<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\Artisan as Artisan;


class AuthorApiTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(){
        parent::setUp();
        Artisan::call('db:seed', ['--class' => 'Seeds\ImporFakeJsonSeeder' ]);
    }

   
    public function testGetOneAuthor()
    {
        $this->get('/api/v1/author/2', [ ])
                ->assertStatus(200)
                ->assertJson(
                    [
                        "data"=>
                            [
                                "id"=> 2,
                                "name"=> "Maria Falsa",
                            ]
                    ]);
    }

    public function testGetAllAuthors()
    {
        $this->get('/api/v1/authors/', [ ])
                ->assertStatus(200)
                ->assertJson(
                    [
                        "data"=>[
                            [
                                "id"=> 1,
                                "name"=> "Clenir Bellezi de Oliveira",
                            ],
                            [
                                "id"=> 2,
                                "name"=> "Maria Falsa",
                            ],
                            [
                                "id"=> 3,
                                "name"=> "Regina Falsa",
                            ],
                            [
                                "id"=> 4,
                                "name"=> "Mauro Falso",
                            ],
                        ]
            ]);
    }
    
    public function testPutSuccess()
    {
        $this->json('PUT', '/api/v1/author/2', ["id"=>2,
                                                'name' => 'Sally'])
                ->assertStatus(200)
                ->assertJson([
                        "message"=> "Autor Editado com sucesso",
                    ]);
    }

    public function testPutFailNotFound()
    {
        $this->json('PUT', '/api/v1/author/2', ["id"=>99,
                                                'name' => 'Sally'])
                ->assertStatus(404)
                ->assertJson([
                        "error"=> "Autor não encontrado",
                    ]);
    }

    public function testPutFailEdit()
    {
        $this->json('PUT', '/api/v1/author/2', ["id"=>2,
                                                'name' => null])
                ->assertStatus(422)
                ->assertJson([
                        "error"=> "Preencha o Nome",
                    ]);
    }

    public function testPostSuccess()
    {
        $this->json('POST', '/api/v1/author/', ['name' => 'Sally'])
                ->assertStatus(200)
                ->assertJson([
                        "message"=> "Autor Criado com sucesso",
                    ]);
    }

    public function testPostFailEdit()
    {
        $this->json('POST', '/api/v1/author/', ['name' => "Maria Falsa"])
                ->assertStatus(422)
                ->assertJson([
                        "error"=> "Autor já cadastrado",
                    ]);
    }

}
