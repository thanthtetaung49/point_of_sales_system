<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // direct user page
    public function userPage() {
        $userData = User::where('role', 'user')->paginate(3);

        return view('admin.userManagement.userList', compact('userData'));
    }

    // direct admin page
    public function adminPage() {
        $userData = User::where('role', 'admin')->paginate(3);

        return view('admin.userManagement.adminList', compact('userData'));
    }
}
