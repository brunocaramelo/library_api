<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domain\Books\Services\BookService;
use Tests\RunSeed\RunSeed;

class BookTest extends TestCase
{
    use RefreshDatabase;
    use RunSeed;
    
    public function setUp()
    {
        parent::setUp();
        $this->runSeed();
    }

    public function testAllBooks()
    {
        $authorService = new BookService();
  
        $this->assertEquals($authorService->getAll()->toArray([]), $this->returnListSeedResult());
    }
    
    public function testBookSuccess()
    {
        $authorService = new BookService();
        $idFind = 2;
        
        $this->assertEquals(
            $authorService->getById($idFind)->toArray([]),
            $this->returnListSeedResult()[1]
        );
    }
    /**
     * @expectedException         \App\Domain\Books\Exceptions\BookNotFoundException
     * @expectedExceptionMessage Autor não encontrado
     */
    // public function testBookFailNotFound()
    // {
    //     $authorService = new BookService();
    //     $idFind = 10;
    //     $authorService->getById($idFind)->toArray([]);
    // }
    
    // public function testCreateBookSuccess()
    // {
    //     $expected = ['name' => 'Tonhão'];

    //     $authorService = new BookService();
    //     $last = $authorService->create($expected);
    //     $final = $authorService->getById($last->id)->toArray([]);
    //     $expected['id'] = $last->id;
    //     $this->assertEquals($final, $expected);
    // }
    /**
     * @expectedException         \App\Domain\Books\Exceptions\BookEditException
     * @expectedExceptionMessage  Autor já cadastrado
     */
    // public function testCreateBookFailExists()
    // {
    //     $expected = ['name' => 'Clenir Bellezi de Oliveira'];

    //     $authorService = new BookService();
    //     $last = $authorService->create($expected);
    //     $final = $authorService->getById($last->id)->toArray([]);
    //     $expected['id'] = $last->id;
    //     $this->assertEquals($final, $expected);
    // }
    
    // public function testUpdateBookSuccess()
    // {
    //     $expected = [
    //         'id' => '2',
    //         'name' => 'Tonhão'
    //     ];

    //     $authorService = new BookService();
    //     $authorService->update($expected['id'], $expected);
    //     $final = $authorService->getById($expected['id'])->toArray([]);
    //     $expected['id'] = $expected['id'];
    //     $this->assertEquals($final, $expected);
    // }
    /**
     * @expectedException         \App\Domain\Books\Exceptions\BookEditException
     * @expectedExceptionMessage  Preencha o Nome
     */
    // public function testUpdateBookFailName()
    // {
    //     $expected = [
    //         'id' => '2',
    //         'name' => null
    //     ];

    //     $authorService = new BookService();
    //     $authorService->update($expected['id'], $expected);
    //     $final = $authorService->getById($expected['id'])->toArray([]);
    //     $expected['id'] = $expected['id'];
    //     $this->assertEquals($final, $expected);
    // }
    /**
     * @expectedException         \App\Domain\Books\Exceptions\BookNotFoundException
     * @expectedExceptionMessage Autor não encontrado
     */
    // public function testUpdateBookFailNotFound()
    // {
    //     $expected = [
    //         'id' => '99',
    //         'name' => 'Tem um nome'
    //     ];

    //     $authorService = new BookService();
    //     $authorService->update($expected['id'], $expected);
    //     $final = $authorService->getById($expected['id'])->toArray([]);
    //     $expected['id'] = $expected['id'];
    //     $this->assertEquals($final, $expected);
    // }
 
    private function returnListSeedResult()
    {
        return json_decode('[{"id":1,"isbn":"7898592131010","title":"Livro Falso 1","cover":"https:\/\/s3-us-west-2.amazonaws.com\/catalogo.ftd.com.br\/files\/uploads\/11603117CJ_resized_596x800.jpg","author":["Clenir Bellezi de Oliveira"],"level":"Ensino m\u00e9dio","discipline":["Literatura","Matem\u00e1tica"],"price":"239"},{"id":2,"isbn":"7898592131058","title":"Livro Falso 2","cover":"https:\/\/s3-us-west-2.amazonaws.com\/catalogo.ftd.com.br\/files\/uploads\/11603118CJ_resized_596x800.jpg","author":["Maria Falsa","Regina Falsa"],"level":"Ensino m\u00e9dio","discipline":["L\u00edngua Portuguesa"],"price":"219"},{"id":3,"isbn":"7898592130853","title":"Livro Falso 3","cover":"https:\/\/s3-us-west-2.amazonaws.com\/catalogo.ftd.com.br\/files\/uploads\/11604000CJ_resized_596x800.jpg","author":["Mauro Falso"],"level":"Ensino m\u00e9dio","discipline":["Gram\u00e1tica","L\u00edngua Portuguesa"],"price":"249"}]',true);
    }
}
