<?php

namespace Admin\Author\Models;

use Illuminate\Support\Facades\Hash;

use Admin\Author\Validators\AuthorValidator;
use Admin\Author\Exceptions\AuthorEditException;
use Admin\Author\Entities\AuthorEntity;
use Admin\Author\Repositories\AuthorRepository;
use Admin\Author\Repositories\AuthorCacheRepository;

class AuthorModel
{
    private $authorRepo = null;
    
    public function __construct()
    {
        $this->authorRepo = new AuthorRepository(new AuthorEntity());
    }

    public function getAll()
    {
        $userCache = new AuthorCacheRepository($this->authorRepo);
        return $userCache->getList();
    }

    public function remove($identify)
    {
        return $this->authorRepo->remove($identify);
    }

    public function create(array $data)
    {
        $validate = new AuthorValidator();
        $validation = $validate->validateCreate($data);
        
        if ($validation->fails() === true) {
            throw new AuthorEditException(implode("\n", $validation->errors()->all()));
        }
        
        return $this->authorRepo->create($data);
    }

    public function update($identify, array $data)
    {
        $validate = new AuthorValidator();
        $validation = $validate->validateUpdate($data);
        if ($validation->fails()) {
            throw new AuthorEditException(implode("\n", $validation->errors()->all()));
        }

        return $this->authorRepo->update($identify, $data);
    }

    public function find($identify)
    {
        $authorCache = new AuthorCacheRepository($this->authorRepo);
        return $authorCache->find($identify);
    }

    public function findByCode($value)
    {
        return $this->findBy('code', $value);
    }

    public function findBy($field, $value)
    {
        return $this->authorRepo->findBy($field, $value)->first();
    }

}