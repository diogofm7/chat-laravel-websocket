<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    public function me()
    {
        $user = auth()->user();
        return response()->json([
            'user' => $user
        ], Response::HTTP_OK);
    }

    public function index()
    {
        $users = User::where('id', '<>', auth()->user()->id)->get();
        return response()->json([
            'users' => $users
        ], Response::HTTP_OK);
    }

    public function show(User $user)
    {
        return response()->json([
            'user' => $user
        ], Response::HTTP_OK);
    }

}
