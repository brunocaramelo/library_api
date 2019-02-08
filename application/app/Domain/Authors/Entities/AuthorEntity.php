<?php

namespace App\Domain\Authors\Entities;

use Illuminate\Database\Eloquent\Model;

class AuthorEntity extends Model
{
    protected $table = 'authors';
    
    protected $fillable = [
                            'name',
                            'presentation',
                        ];
    
    public function books()
    {
        return $this->belongsToMany(\App\Domain\Authors\Entities\BookEntity::class, 'author_id', 'book_id');
    }
    
    public function scopeActive($query)
    {
        return $query->where('status', '=', '1');
    }
}
