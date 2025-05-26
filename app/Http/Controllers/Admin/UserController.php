<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Hash;
use Session;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role','user')->get(); 
        return view('admin.users.list',compact('users'));
    }
    public function show($id)
    {
        $posts = Post::where('user_id',$id)->get();
        return view('admin.users.show', compact('posts'));
    }

}
