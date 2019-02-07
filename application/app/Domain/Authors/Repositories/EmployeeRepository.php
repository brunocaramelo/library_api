<?php

namespace Admin\Employee\Repositories;

use Admin\Employee\Entities\EmployeeEntity;

class AuthorRepository
{
    private $author = null;

    public function __construct(AuthorEntity $author)
    {
        $this->author = $author;
    }

    public function getAll()
    {
        return $this->author->all();
    }

    public function find($identify)
    {
        return $this->author->find($identify);
    }

    public function findBy($field, $value)
    {
        return $this->author->where($field, $value);
    }
    
    public function remove($identify)
    {
        $authorSave = $this->author->find($identify);
        return $authorSave->fill([ 'status' => '0' ])->save();
    }
    
    public function create($data)
    {
        return $this->author->create($data);
    }

    public function update($identify, $data)
    {
        $authorSave = $this->author->find($identify);
        return $authorSave->fill($data)->save();
    }
}
