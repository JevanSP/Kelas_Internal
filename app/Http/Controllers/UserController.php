<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller


{
    public function index() {
        // $users = User::all();
        // return response()->json($users);
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        $data = array(
            'title' => 'User',
            'data_user' => User::all(),
        );
        return view('admin.master.user.list', $data);
    }

    
    public function store(Request $request) {
        // // $user = User::create($request->all());
        // return response()->json($user);
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

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

        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

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
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        $data = User::find($id);
        $data->delete();
        return redirect('/user')->with('success', 'Data Berhasil');
    }


}

