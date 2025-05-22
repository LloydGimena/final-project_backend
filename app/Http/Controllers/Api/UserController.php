<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index()
    {
        $user = User::get();
        if($user)
        {
            return UserResource::collection($user);
        }
        else
        {
            return response()->json(['message' => 'No record available'], 200);
        }
    }
    public function store(request $request )
    {
       $validator = Validator::make($request->all(),[
        
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            
        ]);
        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->messages(),
                'message'=>'All fields are mandatory'],422);
        

            }
        $user = User::create([
           
            'name' => $request->name,
            'email' =>$request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,

        ]);

        return response()->json([
            'message'=>'Login successfully',
            'date'=> new UserResource($user)
        ],200);
    }
    public function show(user $user)
    {
        return new UserResource($user);
    
    }
    public function update(Request $request, user $user)
    {
        $validator = Validator::make($request->all(),[
        
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            
        ]);
        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->messages(),
                'message'=>'All fields are mandatory'],422);
        

            }
        $user = User::update([
           
            'name' => $request->name,
            'email' =>$request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,

        ]);

        return response()->json([
            'message'=>'Updated successfully',
            'date'=> new UserResource($user)
        ],200);
    }
    public function destroy()
    {
       
    }
}
