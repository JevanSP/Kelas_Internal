<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller


    // public function index()
    // {
    //     return view('user.index');
    // }   

    // public function create()
    // {
    //     return view('user.create');
    // }
    
{
    // Display all users
    public function index() {
        $users = User::all();
        return response()->json($users);
    }

    // Store a new user
    public function store(Request $request) {
        $user = User::create($request->all());
        return response()->json($user);
    }

    // Update a user
    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user);
    }

    // Delete a user
    public function destroy($id) {
        User::destroy($id);
        return response()->json(['message' => 'User deleted successfully']);
    }


}

