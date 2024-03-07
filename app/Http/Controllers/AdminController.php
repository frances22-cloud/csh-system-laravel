<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function CreateLecturer(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'sname' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|min:6',
        ]);

        $fname = $request->input('fname');
        $sname = $request->input('sname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $role = 1;
        $password =  Hash::make($request->input('password'));



        $data = array('name' => $fname, "email" => $email, "password" => $password, "role" => $role);
        $id = DB::table('users')->insertGetId($data);

        $data2 = array('fname' => $fname, 'sname' => $sname, "email" => $email, "phone" => $phone, "user_id" => $id);
        DB::table('lecturer')->insert($data2);

        return Redirect()->back();
    }

    public function CreateAdmin(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'sname' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|min:6',
        ]);

        $fname = $request->input('fname');
        $sname = $request->input('sname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $role = 2;
        $password =  Hash::make($request->input('password'));



        $data = array('name' => $fname, "email" => $email, "password" => $password, "role" => $role);
        $id = DB::table('users')->insertGetId($data);

        $data2 = array('fname' => $fname, 'sname' => $sname, "email" => $email, "phone" => $phone, "user_id" => $id);
        DB::table('admin')->insert($data2);
        return Redirect()->back();
    }

    public function CreateUnit(Request $request)
    {
        $name = $request->input('unit_name');
        $capacity = $request->input('capacity');
        $lec = $request->input('lec');

        $data = array('unit_name' => $name, 'capacity' => $capacity, "lecturer_id" => $lec);
        DB::table('units')->insert($data);
        return Redirect()->back();
    }

    public function DeleteUnit(Request $request)
    {
        $id = $request->input('id');

        DB::table('units')->where('id', '=', $id)->delete();

        return Redirect()->back();
    }

    public function DeleteAdmin(Request $request)
    {
        $id = $request->input('id');

        $id2 = DB::table('admin')->where('id', '=', $id)->get('user_id');
        foreach ($id2 as $id2) {
            $id3 = $id2->user_id;
            DB::table('users')->where('id', '=', $id3)->delete();
        }
        DB::table('admin')->where('id', '=', $id)->delete();

        return Redirect()->back();
    }

    public function DeleteLec(Request $request)
    {
        $id = $request->input('id');

        $id2 = DB::table('lecturer')->where('id', '=', $id)->get('user_id');
        foreach ($id2 as $id2) {
            $id3 = $id2->user_id;
            DB::table('users')->where('id', '=', $id3)->delete();
        }
        DB::table('lecturer')->where('id', '=', $id)->delete();

        return Redirect()->back();
    }
}
