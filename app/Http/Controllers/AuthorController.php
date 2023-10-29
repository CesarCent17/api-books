<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Support\Facades\Validator as validator;

class AuthorController extends Controller
{
    public function save(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make( $data, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'country' => 'required|string',
        ],
        [
            'first_name.required' => 'first_name is required',
            'first_name.string' => 'first_name must be of type string',
            'last_name.required' => 'last_name is required',
            'last_name.string' => 'last_name must be of type string',
            'country.required' => 'country is required',
            'country.string' => 'country must be of type string',
        ]);
        if($validator->fails()){
            return response()->json(['error' => $validator->getMessageBag()], 400);
        }

        $author = Author::create($data);
        return response()->json([$author, 201]);
    }

    public function getById($id)
    {
        $author = Author::find($id);
        if(!$author){
            return response()->json(['message' => 'Author not found'], 404);
        }
        return response()->json($author, 200);
    }
}
