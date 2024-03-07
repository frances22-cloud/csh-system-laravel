<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Applications;

class StudentsController extends Controller
{
    public function create(Request $request)
    {
        $students = new Students();

        $students->name = $request->input('name');
        $students->email = $request->input('email');
        $students->number = $request->input('number');
        $students->course = $request->input('course');
        $students->year = $request->input('year');
        $students->address = $request->input('address');
        $password1=123456;
        $password =  Hash::make($password1);

        $data=array('name'=>$request->input('name'),"email"=>$request->input('email'),"password"=>$password,"role"=>0 );
        $user_id=DB::table('users')->insertGetId($data);
        $students->user_id = $user_id;

        $students->save();
        
        $id = $request->input('id');

        Applications::where('id', '=', $id)->update([
		'status' => 1 ,
	]);

    return redirect('/send_mail');
    }

    public function read(){

        $data = Students::all();
        return view('admin_module.view_students')->with('data',$data);
    }


    public function update(Request $request){

        $id = $request->input('id');

        Applications::where('id', '=', $id)->update([
		'status' => 2 ,
	]);

    return redirect()->back();
    }


    public function delete(Request $request){
        $id = $request->input('id');

        Students::where('id', '=', $id)->delete();
		
    return redirect()->back();
    }


}
