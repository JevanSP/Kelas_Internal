<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller


{
    public function index() {
        // $users = User::all();
        // return response()->json($users);
        $data = array(
            'title' => 'User',
            'data_user' => User::all(),
        );
        return view('admin.master.user.list', $data);
    }

    
    public function store(Request $request) {
        // // $user = User::create($request->all());
        // return response()->json($user);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
        return redirect('/user')->with('success', 'Data Berhasil');
    }   


    public function update(Request $request, $id) {
        // $user = User::findOrFail($id);
        // $user->update($request->all());
        // return response()->json($user);
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
        return redirect('/user')->with('success', 'Data Berhasil');
    }

    // Delete a user
    public function destroy($id) {
        // User::destroy($id);
        // return response()->json(['message' => 'User deleted successfully']);
        $data = User::find($id);
        $data->delete();
        return redirect('/user')->with('success', 'Data Berhasil');
    }


}

