<?php

namespace App\Domain\Disciplines\Repositories;

use Illuminate\Support\Facades\Cache;

use App\Infrastructure\Contracts\BaseCacheRepositoryContract;

use App\Infrastructure\Contracts\BaseRepositoryContract;

class DisciplineCacheRepository implements BaseCacheRepositoryContract
{
    protected $disciplines;

    public function __construct(BaseRepositoryContract $disciplines)
    {
        $this->disciplines = $disciplines;
    }

    public function getAll()
    {
        return Cache::remember('discipline.list', 10 ,function () {
            return $this->disciplines->getAll();
        });
    }

  
    public function find($identify)
    {
        return Cache::remember("discipline.{$identify}", 60 ,function () use ($identify) {
            return $this->disciplines->find($identify);
        });
    }
}