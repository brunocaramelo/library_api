<?php

namespace App\Domain\Books\Services;

use App\Domain\Books\Validators\BookValidator;
use App\Domain\Books\Exceptions\BookEditException;
use App\Domain\Books\Exceptions\BookNotFoundException;
use App\Domain\Books\Entities\BookEntity;
use App\Domain\Books\Repositories\BookRepository;
use App\Domain\Books\Repositories\BookCacheRepository;

use App\Domain\Books\Resources\BookListResource;
use App\Domain\Books\Resources\BookResource;

class BookService
{
    private $bookRepo;
    
    public function __construct()
    {
        $this->bookRepo = new BookRepository(new BookEntity());
    }

    public function getAll(): BookListResource
    {
        $userCache = new BookCacheRepository($this->bookRepo);
        return new BookListResource($userCache->getAll());
    }

    public function create(array $data): BookEntity
    {
        $validate = new BookValidator();
        $validation = $validate->validateCreate($data);
        
        if ($validation->fails() === true) {
            throw new BookEditException(implode("\n", $validation->errors()->all()));
        }
        
        return $this->bookRepo->create($data);
    }

    public function update($identify, array $data): bool
    {
        $validate = new BookValidator();
        $validation = $validate->validateUpdate($data);
        
        if ($validation->fails()) {
            throw new BookEditException(implode("\n", $validation->errors()->all()));
        }
        
        if ($this->bookRepo->find($identify) === null) {
            throw new BookNotFoundException('Autor não encontrado');
        }

        return $this->bookRepo->update($identify, $data);
    }

    public function getById($identify): BookResource
    {
        $authorCache = new BookCacheRepository($this->bookRepo);
        $found = $authorCache->find($identify);
        if ($found === null) {
            throw new BookNotFoundException('Autor não encontrado');
        }
        return new BookResource($found);
    }
   
}