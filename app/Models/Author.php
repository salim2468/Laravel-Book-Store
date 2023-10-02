<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;

    protected $fillable =['name','image_path'];

    protected $hidden =[
        'laravel_through_key',
        'created_at',
        'updated_at'
    ];

    public function book(){
        return $this->belongsToMany(
            Book::class,
            'book_author'
        );
    }
}
