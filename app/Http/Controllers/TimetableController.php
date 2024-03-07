<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timetable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class TimetableController extends Controller
{
    public function AllocateClasses(Request $request)
    {
        $timetable = new Timetable();

        $request->validate([
            'unit' => 'required',
            'venue' => 'required',
            'datetime' => 'required',
        ]);

        $timetable->unit = $request->input('unit');
        $timetable->venue = $request->input('venue');
        $timetable->datetime = $request->input('datetime');

        $timetable->save();
        
        return Redirect()->back();
    }
}
