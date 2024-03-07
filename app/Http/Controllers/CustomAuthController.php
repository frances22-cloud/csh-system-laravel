<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CustomAuthController extends Controller
{
    public function index()
    {
        return view('login_reg');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect("dashboard");
        } else {
            return redirect("login_reg")->withSuccess('Login details are not valid');
        }
    }

    public function registration()
    {
        return view('login_reg');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $password =  Hash::make($request->input('password'));
        $data = array('name' => $name, "email" => $email, "password" => $password);
        DB::table('users')->insert($data);


        return redirect("login_reg")->withSuccess('Successfully registered');
    }


    public function dashboard()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'student') {
                $id=DB::table('students')->where('user_id','=',Auth::user()->id)->select('id')->get();
                foreach ($id as $id) {
                    session(['student_id' => $id->id]);  
                }
                return Redirect('Stud_Classes_Select');
            }
            if (Auth::user()->role == 'lecturer') {
                $id=DB::table('lecturer')->where('user_id','=',Auth::user()->id)->select('id')->get();
                foreach ($id as $id) {
                    session(['lecturer_id' => $id->id]);  
                }
                return Redirect('Lec_Classes_Select');
            }
            if (Auth::user()->role == 'admin') {
                return Redirect('view_applications');
            }
            if (Auth::user()->role == 'staff') {
                return Redirect('chatify');
            }
        }

        return redirect("login_reg")->withSuccess('Please Log In');
    }

    public function signOut(Request $request)
    {
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        Auth::logout();

        return Redirect('login_reg');
    }
}
