<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $User = user::get();
        if($User)
        {
            return UserResource::collect($User);
        }
        else
        {
            return response()->json(['message' => 'No record available'], 200);
        }
    }
    public function store()
    {

    }
    public function show()
    {

    }
    public function update()
    {

    }
    public function destroy()
    {

    }
}
