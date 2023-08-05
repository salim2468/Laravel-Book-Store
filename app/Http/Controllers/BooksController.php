<?php

namespace App\Http\Controllers;


use App\Models\Book;
use App\Models\Author;

use Illuminate\Http\Request;
use App\Http\Resources\BooksResource;
use App\Http\Requests\UpdateBookRequest;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return BooksResource::collection(Book::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $book = Book::create([
            'name' => $request->name,
            'description' => $request->description,
            'publication_year' => $request->publication_year,
            'price' => $request->price,
        ]);

        $authorList =  $request->authors;
        // if (is_array($l)) {
        // echo('yes');
        // }
        $book->author()->attach($authorList);
        return new BooksResource($book);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return new BooksResource($book);
        //        return $book->author;

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        echo ($book);
        //
        // $book->update([
        //     'name' => $request->name,
        //     'description' => $request->description,
        //     'publication_year' => $request->publication_year,
        //     'price' => $request->price
        // ]);

        $book = Book::findOrFail($book->id);
        $book->update([
            'name' => $request->name,
            'description' => $request->description,
            'publication_year' => $request->publication_year,
            'price' => $request->price,
        ]);
        $book->author()->detach();
        $authorList = $request->authors;
        $book->author()->attach($authorList);

        return new BooksResource($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        echo ($id);
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        $book->author()->detach();
        $book->delete();
        return response()->json(['message' => 'Book deleted successfully'], 200);
        // return response(null,204);
    }


    public function searchBook(Request $request)
    {   //$keyword
        // $keyword = $request['search'] ?? "";
        $keyword = $request->query('search');

        $resultBook = Book::where('name', 'LIKE', "%$keyword%")->get();

        return BooksResource::collection($resultBook);
        // return response()->json($resultBook);
    }
}
