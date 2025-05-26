<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function checklogin(Request $request)
    {

       $validator =  $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        
        //$credentials = $request->only('email', 'password');
        if (Auth::attempt(['email' => $request->email,'password' => $request->password,'role' => 'admin'])) {

            return redirect()->intended('admin/dashboard')
                        ->withSuccess('Signed in');
        }
        
        $validator['emailPassword'] = 'Email address or password is incorrect.';
        return redirect("admin/login")->withErrors($validator);
    }



    public function registration()
    {
        return view('auth.registration');
    }

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('You have signed-in');
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'role' => 'user',
        'password' => Hash::make($data['password'])
      ]);
      
    }

    public function dashboard()
    {

        
        if (Auth::guard('web')->check()) {
            return view('admin.dashboard');
        }
        
  
        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
