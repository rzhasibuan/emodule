<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index(){
        return view('login');
    }

    public function login_process(Request $request){
        if(Auth::attempt($request->only('email','password'))){
            return redirect('/admin')->with([
                'success' => 'Success Login!'
            ]);
        }

        return redirect()
        ->route('login')
        ->with([
            'error' => 'Wrong Email or Password!'
        ]);
    }

    public function register(){
        return view('register');
    }

    public function register_process(Request $request){
        // dd($request->all());
        $this->validate($request, [
            'email'=>'unique:users,email',
            'password' => 'min:6',
        ]);

        $post = User::create([
            'name' => $request->name,
            'id_level' => '2',
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        if ($post) {
            return redirect()
                ->route('register')
                ->with([
                    'success' => 'Register Success Please Log in!'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }

    public function logout(){
        Auth::logout();

        return redirect()
        ->route('login')
        ->with([
            'success' => 'Success Logout!'
        ]);
    }
}
