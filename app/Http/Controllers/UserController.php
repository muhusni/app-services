<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'name', 'username', 'email')->get();
        return response()->json($users);
    }

    public function show($id)
    {
        $user = User::findOrFail($id, ['id', 'name', 'username', 'email']);
        return response()->json($user);
    }
}