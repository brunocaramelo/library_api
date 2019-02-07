<?php

namespace App\Domain\Authors\Repositories;

use Illuminate\Support\Facades\Cache;

class AuthorsCacheRepository
{
    protected $authors;

    public function __construct(EmployeeRepository $authors)
    {
        $this->authors = $authors;
    }

    public function getList()
    {
        return Cache::remember('author.list', 10 ,function () {
            return $this->authors->getList()->get();
        });
    }

  
    public function find($identify)
    {
        return Cache::remember("authors.{$identify}", 60 ,function () use ($identify) {
            return $this->authors->find($identify);
        });
    }
}