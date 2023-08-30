<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Resources\BooksResource;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        echo ($request->limit);
        $page_size = request('limit', Book::count());
        return BooksResource::collection(Book::paginate($page_size));
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
            'page_no' => $request->page_no ?? 0,
            'language' => $request->language,
            'isbn' => $request->isbn,
            'genere' => $request->genere,
        ]);

        $authorList =  $request->authors;
        $book->author()->attach($authorList);
        return new BooksResource($book);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return new BooksResource($book);
        // return $book->author;

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
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if ($book) {
            $book->update([
                'name' => $request->name,
                'description' => $request->description,
                'publication_year' => $request->publication_year,
                'price' => $request->price,
                'page_no' => $request->page_no,
                'language' => $request->language,
                'isbn' => $request->isbn,
                'genere' => $request->genere,
            ]);
            $book->author()->detach();
            $authorList = $request->authors;
            $book->author()->attach($authorList);
            return new BooksResource($book);
        } else {
            return response(['message' => "No Book found"]);
        }
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

    public function searchBook($search)
    {
        $resultBook = Book::where('name', 'LIKE', "%$search%")->get();
        return BooksResource::collection($resultBook);
    }

    public function uploadImage(Request $request)
    {
        echo ("inside uploadImage");
        if ($request->hasFile('image')) {
            // $image = $request->file('image');
            $image = $request->image;

            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('book'), $imageName);

            $book = Book::find($request->user_id);
            $book->update([
                'image_path' => 'book/' . $imageName
            ]);

            return response()->json([
                'message' => 'Image uploaded successfully',
                'value' => 'profile/' . $imageName,
                'user_id' => $request->user_id,
            ]);
        }
        return response()->json(['message' => 'No image file uploaded'], 400);
    }
}
