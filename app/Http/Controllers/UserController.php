<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Task;
use App\Models\User;
use App\Models\Organization;

class UserController extends Controller
{

    public function index()
{
        if (Auth::check()) {
    if(Auth::user()->type == 'organization') {
        $users = User::where('organization_id', Auth::user()->organization_id)->get();
        return view('users.index', compact('users'));
    } else {
        return redirect()->back()->with('error', 'Access denied.');
    }
        } else {
            return redirect('login')->with('error', 'You need to login first.');
        }
}

    public function editUser($userId)
    {
        $user = User::findOrFail($userId);
        return view('users.edit', compact('user'));
    }

    public function updateUser(Request $request, $userId)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $userId,
            'username' => 'sometimes|string|max:255|unique:users,username,' . $userId,
            'password' => 'sometimes|nullable|min:8',
        ]);

        $user = User::findOrFail($userId);
        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('username')) {
            $user->username = $request->username;
        }
        if ($request->has('password') && !empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Method to handle adding a new user
    public function addUser(Request $request, $organizationId)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            // Add more validation rules as needed
        ]);

        // Create new user
        $user = new User();
        $user->name = $request->input('name');
        // Set other user fields...
        $user->organization_id = $organizationId;
        $user->save();

        return redirect()->route('organization.users', $organizationId)->with('success', 'User added successfully');
    }

    // Method to show the form for editing a user
    public function showEditUserForm($userId)
    {
        // Fetch the user details
        $user = User::findOrFail($userId);

        return view('users.edit', compact('user'));
    }

    // Method to handle editing a user
    

    // Method to handle deleting a user
    public function deleteUser($userId)
    {
        // Find the user
        $user = User::findOrFail($userId);

        // Delete the user
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully');
    }
}
