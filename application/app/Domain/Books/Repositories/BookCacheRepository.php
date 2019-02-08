<?php

namespace App\Domain\Books\Repositories;

use Illuminate\Support\Facades\Cache;

use App\Infrastructure\Contracts\BaseCacheRepositoryContract;

use App\Infrastructure\Contracts\BaseRepositoryContract;

class BookCacheRepository implements BaseCacheRepositoryContract
{
    protected $authors;

    public function __construct(BaseRepositoryContract $authors)
    {
        $this->authors = $authors;
    }

    public function getAll()
    {
        return Cache::remember('book.list', 10 ,function () {
            return $this->authors->getAll();
        });
    }

  
    public function find($identify)
    {
        return Cache::remember("book.{$identify}", 60 ,function () use ($identify) {
            return $this->authors->find($identify);
        });
    }
}