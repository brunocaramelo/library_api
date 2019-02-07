<?php

namespace App\Domain\Levels\Entities;

use Illuminate\Database\Eloquent\Model;

class LevelEntity extends Model
{
    protected $table = 'levels';
    
    protected $fillable = [
                            'isbn',
                            'title',
                            'cover',
                            'price',
                        ];
}
