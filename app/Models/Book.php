<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','publication_year','price']; 

    public function author(){
        return $this->belongsToMany(
            Author::class,
            'book_author'
        );
    }
}



// public function author(){
//     return $this->hasManyThrough(
//         '\App\Models\Author',
//         'App\Models\BookAuthor',
//         // below parameters are optional 
//         'book_id',
//         'id',
//         'id',
//         'author_id',
//     );
// }