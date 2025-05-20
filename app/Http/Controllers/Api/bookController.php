<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\bookResource;
use App\Models\books;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class bookController extends Controller
{
    public function index()
    {
    
        $books = books::get();
        if($books ->count() >0 )
        {
            return bookResource::collection($books);
        }
        else
        {
            return response()->json(['message' => 'No record available'],200);
        }
    }
        
    public function store(request $request)
    {
        $validator = Validator::make($request->all(),[
        
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            
        ]);
        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->messages(),
                'message'=>'All fields are mandatory'],422);
        

            }
        $books = books::create([
           
            'title' => $request->title,
            'author' =>$request->author,
            'genre' => $request->genre,

        ]);

        return response()->json([
            'message'=>'Book created successfully',
            'date'=> new bookResource($books)
        ],200);
    
    }

    
    public function show(books $book)
    {
        return new bookResource($book);
    }
    public function update(Request $request, books $book)
    {
       $validator = Validator::make($request->all(),[
        
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            
        ]);
        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->messages(),
                'message'=>'All fields are mandatory'],422);
        

            }
        $book ->update([
           
            'title' => $request->title,
            'author' =>$request->author,
            'genre' => $request->genre,

        ]);

        return response()->json([
            'message'=>'Book updated successfully',
            'date'=> new bookResource($book)
        ],200); 
    }
    public function destroy(books $book)
    {
        $book -> delete();
        return response()->json([
            'message'=>'Book deleted successfully',
        ],200);

    }

}
