<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class StaffController extends Controller
{
    //
    public function staff_register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $department = $request->input('department');
        $role = $request->input('role');
        $password =  Hash::make($request->input('password'));

        

        $data=array('name'=>$name,"email"=>$email,"password"=>$password,"role"=>$role );
        $id=DB::table('users')->insertGetId($data);

        $data2=array('name'=>$name,"email"=>$email,"department"=>$department,"user_id"=>$id );
        DB::table('staff')->insert($data2);
        return Redirect("staff_members");

    }
}
