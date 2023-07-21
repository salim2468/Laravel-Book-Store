<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorsRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Resources\AuthorsResource;



class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return AuthorsResource::collection(Author::all());
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
    public function store(AuthorsRequest $request)
    {
        
        // AuthorsRequest inplace of Request because,
        // validation is done form AuthorsResquest class present in app/Http/Request


        $author = Author::create([
            'name' => $request->name
        ]);
        return new AuthorsResource($author);
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        // return $author;   
        // output:
        // {
        //     "id": 2,
        //     "name": "Mrs. Rubie Stanton",
        //     "created_at": "2023-07-05T11:44:55.000000Z",
        //     "updated_at": "2023-07-05T11:44:55.000000Z"
        // }

        return new AuthorsResource($author);

        // TODO:
        // https://youtu.be/xvqPEEpRBJ4?t=3938
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorsRequest $request, Author $author)
    {
        // AuthorsRequest inplace of Request because,
        // validation is done form AuthorsResquest class present in app/Http/Request

        $author->update([
            'name' => $request->name
        ]);
        return new AuthorsResource($author);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        //
        $author->delete();
        return response(null,204);
         
    }
}
