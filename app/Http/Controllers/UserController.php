<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $modal;
    public function __construct(UserService $userService)
    {
        $this->modal = $userService;
    }
    public function index()
    {
        $users = $this->modal->fetchall();
        $roles = Role::where('status', 1)->get();
        return view('User.index', compact('users', 'roles'));
    }

    public function fetchStatus($id)
    {
        try {

            $data = User::where('id', $id)->get();
            return response()->json(['success' => true, 'message' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function create()
    {
        $roles = Role::where('status', 1)->get();
        return view('User.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'email|required|unique:users,email',
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password',
            'role_id' => 'required'
        ]);

        $this->modal->storeUser($data);
        return redirect()->route('user.index')->with(['message' => 'User Created Successfully']);
    }

    public function updateStatus(Request $request, $id)
    {
        try {

            $data = User::find($id);
            $data->update([
                'is_verified' => $request->status
            ]);
            return response()->json(['success' => true, 'message' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // Password Update
    public function updatePassword(Request $request, $id)
    {
        try {
            $request->validate([
                'password' => 'required|min:4',
                'confirm_password' => 'required|same:password'
            ]);
            $data = User::find($id);
            $data->update([
                'password' => $request->password
            ]);
            return response()->json(['success' => true, 'message' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function fetchUserData($id)
    {
        try {
            $data = User::where('id', $id)->get();
            return response()->json(['success' => true, 'message' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function updateDdetail(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|min:4',
                'email' => 'required|email'
            ]);
            $data = User::find($id);
            $data->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id,
            ]);
            return response()->json(['success' => true, 'message' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


























    public function logout()
    {
        Auth::logout();
        return redirect('/')->with(['message' => 'Logout Successfully']);
    }
}
