<?php

namespace App\Domain\Authors\Repositories;

use Illuminate\Support\Facades\Cache;

use App\Infrastructure\Contracts\BaseCacheRepositoryContract;

use App\Infrastructure\Contracts\BaseRepositoryContract;

class AuthorCacheRepository implements BaseCacheRepositoryContract
{
    protected $authors;

    public function __construct(BaseRepositoryContract $authors)
    {
        $this->authors = $authors;
    }

    public function getAll()
    {
        return Cache::remember('author.list', 10 ,function () {
            return $this->authors->getAll();
        });
    }

  
    public function find($identify)
    {
        return Cache::remember("authors.{$identify}", 60 ,function () use ($identify) {
            return $this->authors->find($identify);
        });
    }
}