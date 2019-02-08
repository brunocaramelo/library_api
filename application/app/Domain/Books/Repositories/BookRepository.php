<?php

namespace App\Domain\Books\Repositories;

use App\Domain\Books\Entities\BookEntity;
use App\Infrastructure\Contracts\BaseRepositoryContract;

class BookRepository implements BaseRepositoryContract
{
    private $book = null;

    public function __construct(BookEntity $book)
    {
        $this->book = $book;
    }

    public function getAll()
    {
        return $this->book->all();
    }

    public function find($identify)
    {
        return $this->book->find($identify);
    }

    public function create($data)
    {
        return $this->book->create($data);
    }

    public function update($identify, $data)
    {
        $bookSave = $this->book->find($identify);
        return $bookSave->fill($data)->save();
    }
}
