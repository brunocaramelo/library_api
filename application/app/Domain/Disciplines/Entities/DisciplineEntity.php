<?php

namespace App\Domain\Disciplines\Entities;

use Illuminate\Database\Eloquent\Model;

class DisciplineEntity extends Model
{
    protected $table = 'disciplines';
    
    protected $fillable = [
                            'isbn',
                            'title',
                            'cover',
                            'price',
                        ];
    
    public function books()
    {
        return $this->belongsToMany(App\Authors\Entities\BookEntity::class, 'book_authors','author_id', 'discipline_id');
    }
}
