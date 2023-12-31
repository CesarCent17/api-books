<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator as validator;

class BookController extends Controller
{
    public function get()
    {
        $books = Book::all();
        return response()->json($books, 200);
    }

    public function getById($id)
    {
        $book = Book::find($id);
        if(!$book){
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json($book, 200);
    }


    public function save(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make( $data, [
            'name' => 'required|string',
            'author_id' => 'required|exists:authors,id',
            // 'author' => 'required|string'
        ],
        [
            'name.required' => 'name is required',
            'name.string' => 'name must be of type string',
            'author_id.required' => 'author is required',
            'author_id.exists' => 'author does not exist',
            // 'author.required' => 'author is required',
            // 'author.string' => 'author must be of type string',
        ]
        );

        if($validator->fails()){
            return response()->json(['error' => $validator->getMessageBag()], 400);
        }
        // $book = Book::create($data);

        $book = Book::create([
            'name' => $data['name'],
            'author_id' => $data['author_id'],
        ]);
        return response()->json([$book, 201]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'author_id' => 'required|exists:authors,id',
        ], [
            'name.required' => 'name is required',
            'name.string' => 'name must be of type string',
            'author_id.required' => 'author is required',
            'author_id.exists' => 'author does not exist',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->getMessageBag()], 400);
        }
        $book = Book::find($id);
        if(!$book){
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->update([
            'name' => $data['name'],
            'author_id' => $data['author_id'],
        ]);
        return response()->json([$data, 200]);
    }

    public function delete($id)
    {
        $book = Book::find($id);
        if(!$book){
            return response()->json(['message' => 'Book not found'], 404);
        }
        $book->delete();
        return response()->json(['message' => 'Book deleted'], 200);
    }
}
