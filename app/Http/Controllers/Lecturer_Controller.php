<?php

namespace App\Http\Controllers;

use App\Models\LecturerMaterial;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;

session_start();

class Lecturer_Controller extends Controller
{
    public function uploadLecMaterial(Request $request)
    {
        $data = new LecturerMaterial();
        $file = $request->file;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $request->file->move('assets/lec_student_assets', $filename);
        $data->file = $filename;
        $data->material_name = $request->input('MaterialName');
        $data->topic_name = $request->input('TopicID');
        $data->unit_code = session('unit_id');
        $data->save();
        return redirect('/Lec_Material');
    }

    public function viewMaterials($material_id)
    {
        $data = LecturerMaterial::where('lec_mat_id', "=", $material_id)->get();
        return view('Lecturer_Student_Module/view_material_files')->with('data', $data);
    }

    public function createAssignment(Request $request)
    {
        $assignment_name = $request->input('AssignmentName');
        $deadline = $request->input('deadline');
        $description = $request->input('description');
        $unit_code = $request->input('unit_code');
        $file = $request->file;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $request->file->move('assets/lec_student_assets', $filename);
        $data = array('assignment_name' => $assignment_name, 'unit_code' => $unit_code, 'deadline' => $deadline, 'description' => $description, 'file' => $filename);
        DB::table('lecturer_assignments')->insert($data);
        return redirect('/Lec_Assignment');
    }

    public function lecDeleteAssignment(Request $request)
    {
        $lec_ass_id = $request->input('lec_ass_id');
        DB::table('lecturer_assignments')->where('lec_ass_id', "=", $lec_ass_id)->delete();
        return redirect('/Lec_Assignment');
    }

    public function viewAssFiles($material_id)
    {
        $data = DB::table('lecturer_assignments')->where('lec_ass_id', "=", $material_id)->get();
        return view('Lecturer_Student_Module/view_assignment_files')->with('data', $data);
    }

    public function submissionDetails($assignment_id)
    {
        $student_id = session('student_id');
        $data = DB::table('assiggnment_submissions')->where('assignment_id', '=', $assignment_id)->where('student_id', '=', $student_id)->get();
        $data2 = DB::table('lecturer_assignments')->where('lec_ass_id', "=", $assignment_id)->get();
        return view('Lecturer_Student_Module.Student.Classes.submission')->with('data2', $data2)->with('data', $data);
    }

    public function submitAssignment(Request $request)
    {
        $assignment_id = $request->input('assignment_id');
        $date = now();
        $student_id = session('student_id');
        $file = $request->file;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $request->file->move('assets/lec_student_assets', $filename);
        $data = array('assignment_id' => $assignment_id, 'date' => $date, 'student_id' => $student_id, 'file' => $filename);
        DB::table('assiggnment_submissions')->insert($data);
        return redirect()->back();
    }

    public function deleteAssignment(Request $request)
    {
        $id = $request->input('id');
        DB::table('assiggnment_submissions')->where('ass_sub_id', '=', $id)->delete();
        return redirect()->back();
    }

    public function editAssignment(Request $request)
    {
        $id = $request->input('id');
        $file = $request->file;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $request->file->move('assets/lec_student_assets', $filename);
        DB::table('assiggnment_submissions')->where('ass_sub_id', '=', $id)->update(['file' => $filename]);
        return redirect()->back();
    }

    public function viewAssignmentSubmission($material_id)
    {
        $data = DB::table('assiggnment_submissions')->where('ass_sub_id', "=", $material_id)->get();
        return view('Lecturer_Student_Module/view_assignment_files')->with('data', $data);
    }

    public function LecViewSubmissions($assignment_id)
    {
        $data = DB::table('assiggnment_submissions')
            ->join('students', 'assiggnment_submissions.student_id', '=', 'students.id')
            ->select('assiggnment_submissions.ass_sub_id', 'students.id', 'students.name', 'assiggnment_submissions.date')
            ->where('assignment_id', "=", $assignment_id)->get();
        return view('Lecturer_Student_Module.Lecturer.Classes.view_assignment')->with('data', $data);
    }

    public function createExam(Request $request)
    {
        $ExamName = $request->input('ExamName');
        $UnitCode = session('unit_id');
        $date = $request->input('date');
        $MaxScore = $request->input('MaxScore');
        $Weight = $request->input('Weight');
        $data = array('exam_name' => $ExamName, 'unit_code' => $UnitCode, 'date' => $date, 'maximum' => $MaxScore, 'weight' => $Weight);
        DB::table('exams')->insert($data);
        return redirect()->back();
    }

    public function fetchExamDetails(Request $request)
    {
        $ExamID = $request->input('ExamID');
        session(['exam_id' => $ExamID]);
        $data = DB::table('exams')->where('unit_code', '=', session('unit_id'))->get();
        $data2 = DB::table('exams')->where('exam_id', '=', $ExamID)->get();
        $check = DB::table('student_results')->where('exam_id', '=', session('exam_id'))->get();
        if (!$check->isEmpty()) {
            $data4 = DB::table('students')
                ->join('enrollments', 'enrollments.student_id', '=', 'students.id')
                ->join('student_results', 'student_results.student_id', '=', 'students.id')
                ->where('enrollments.unit_id', '=', session('unit_id'))
                ->where('exam_id', '=', session('exam_id'))
                ->select('students.id', 'students.name', 'student_results.value')->get();
            return view('Lecturer_Student_Module.Lecturer.Results.update_results')->with('data', $data)->with('data2', $data2)->with('data4', $data4);
        } else {
            $data4 = DB::table('students')
                ->join('enrollments', 'enrollments.student_id', '=', 'students.id')
                ->where('enrollments.unit_id', '=', session('unit_id'))
                ->select('students.id', 'students.name')->get();
            return view('Lecturer_Student_Module.Lecturer.Results.update_results')->with('data', $data)->with('data2', $data2)->with('data4', $data4);
        }
    }

    public function updateStudentResults(Request $request)
    {
        $check = DB::table('student_results')->where('exam_id', '=', session('exam_id'))->get();

        if (!$check->isEmpty()) {
            for ($i = 1; $i <= count($request->student_id); $i++) {
                $id = $request->student_id[$i];
                $exam_id = $request->exam_id[$i];
                DB::table('student_results')
                    ->where('student_id', '=', $id)
                    ->where('exam_id', '=', $exam_id)
                    ->update([
                        'student_id' => $request->student_id[$i],
                        'exam_id' => $request->exam_id[$i],
                        'value' => $request->value[$i]
                    ]);
            }
            return redirect('view_results');
        } else {
            for ($i = 1; $i <= count($request->student_id); $i++) {
                $answers[] = [
                    'student_id' => $request->student_id[$i],
                    'exam_id' => $request->exam_id[$i],
                    'value' => $request->value[$i]
                ];
            }

            DB::table('student_results')->insert($answers);
            return redirect('view_results');
        }
    }

    public function updateStudentAttendance(Request $request)
    {
        for ($i = 1; $i <= 2; $i++) {
            $date = $request->date[$i];
        }
        $check = DB::table('attendance')->where('date', '=', $date)->where('unit_code', '=', session('unit_id'))->get();

        if (!$check->isEmpty()) {
            for ($i = 1; $i <= count($request->student_id); $i++) {
                $id = $request->student_id[$i];
                $date = $request->date[$i];
                $unit_id = $request->unit_id[$i];

                DB::table('attendance')
                    ->where('student_id', '=', $id)
                    ->where('date', '=', $date)
                    ->where('unit_code', '=', $unit_id)
                    ->update([
                        'status' => $request->status[$i],
                    ]);
            }
            return redirect('view_class_attendance');
        } else {
            for ($i = 1; $i <= count($request->student_id); $i++) {
                $id = $request->student_id[$i];
                $answers[] = [

                    'student_id' => $request->student_id[$i],
                    'date' => $request->date[$i],
                    'unit_code' => $request->unit_id[$i],
                    'status' => $request->status[$i]
                ];
            }

            DB::table('attendance')->insert($answers);
            return redirect('view_class_attendance');
        }
    }

    public function editStudentResults(Request $request)
    {
        $student_id = $request->input('student_id');
        $data5 = DB::table('student_results')
            ->join('exams', 'student_results.exam_id', '=', 'exams.exam_id')
            ->where('student_id', '=', $student_id)
            ->where('exams.unit_code', '=', session('unit_id'))
            ->select('student_results.value', 'exams.maximum', 'exams.weight', 'exams.exam_name', 'student_results.result_id')->get();
        $data6 = DB::table('students')
            ->where('id', '=', $student_id)->get();
        return view('Lecturer_Student_Module.Lecturer.Results.edit_results')->with('data5', $data5)->with('data6', $data6);
    }

    public function editStudentResults2(Request $request)
    {
        for ($i = 1; $i <= count($request->result_id); $i++) {
            $id = $request->result_id[$i];
            DB::table('student_results')
                ->where('result_id', '=', $id)
                ->update([
                    'value' => $request->value[$i]
                ]);
        }
        return redirect('view_results');
    }

    public function lecAttUnitSelector(Request $request)
    {
        $unit_id = $request->input('unit_id');
        $unit_name = $request->input('unit_name');
        session(['unit_id' => $unit_id]);
        session(['unit_name' => $unit_name]);
        return redirect('/update_attendance');
    }

    public function lecClassUnitSelector(Request $request)
    {
        $unit_id = $request->input('unit_id');
        $unit_name = $request->input('unit_name');
        session(['unit_id' => $unit_id]);
        session(['unit_name' => $unit_name]);
        return redirect('Lec_Class');
    }

    public function lecResUnitSelector(Request $request)
    {
        $unit_id = $request->input('unit_id');
        $unit_name = $request->input('unit_name');
        session(['unit_id' => $unit_id]);
        session(['unit_name' => $unit_name]);
        return redirect('/update_results');
    }

    public function studAttUnitSelector(Request $request)
    {
        $unit_id = $request->input('unit_id');
        $unit_name = $request->input('unit_name');
        session(['unit_id' => $unit_id]);
        session(['unit_name' => $unit_name]);
        return redirect('Stud_View_Attendance');
    }

    public function studClassUnitSelector(Request $request)
    {
        $unit_id = $request->input('unit_id');
        $unit_name = $request->input('unit_name');
        session(['unit_id' => $unit_id]);
        session(['unit_name' => $unit_name]);
        return redirect('Stud_Class');
    }

    public function studResUnitSelector(Request $request)
    {
        $unit_id = $request->input('unit_id');
        $unit_name = $request->input('unit_name');
        session(['unit_id' => $unit_id]);
        session(['unit_name' => $unit_name]);
        return redirect('Stud_View_Results');
    }

    public function chooseDate(Request $request)
    {
        $date = $request->input('date');
        $data['date'] = $date;
        $check = DB::table('attendance')->where('unit_code', '=', session('unit_id'))->where('date', '=', $date)->get();
        if (!$check->isEmpty()) {
            $data4 = DB::table('students')
                ->join('enrollments', 'enrollments.student_id', '=', 'students.id')
                ->join('attendance', 'attendance.student_id', '=', 'students.id')
                ->where('enrollments.unit_id', '=', session('unit_id'))
                ->where('date', '=',  $date)
                ->select('students.id', 'students.name', 'attendance.status')->get();
            return view('Lecturer_Student_Module.Lecturer.Attendance.update_attendance')->with('data4', $data4)->with('data', $data);
        } else {

            $data4 = DB::table('students')
                ->join('enrollments', 'enrollments.student_id', '=', 'students.id')
                ->where('enrollments.unit_id', '=', session('unit_id'))
                ->select('students.id', 'students.name')->get();
            return view('Lecturer_Student_Module.Lecturer.Attendance.update_attendance')->with('data4', $data4)->with('data', $data);
        }
    }

    public function chooseViewDate(Request $request)
    {
        $date = $request->input('date');
        $data4 = DB::table('students')
            ->join('enrollments', 'enrollments.student_id', '=', 'students.id')
            ->join('attendance', 'attendance.student_id', '=', 'students.id')
            ->where('enrollments.unit_id', '=', session('unit_id'))
            ->where('date', '=',  $date)
            ->select('students.id', 'students.name', 'attendance.status')->get();
        $data2['date'] = $date;
        $data = DB::table('attendance')->where('unit_code', '=', session('unit_id'))->select('date')->distinct()->get();
        return view('Lecturer_Student_Module.Lecturer.Attendance.view_class_attendance')->with('data', $data)->with('data4', $data4)->with('data2', $data2);
    }

    public function viewTimetable($timetable)
    {
        $data = DB::table('timetable')->where('timetable', "=", $timetable)->get();
        return view('Lecturer_Student_Module.Timetable.view_timetable')->with('data', $data);
    }

    public function changePassword()
    {
        return view('Lecturer_Student_Module.Student.change_password');
    }

    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }

    public function Enroll(Request $request)
    {
        $unit_id = $request->input('unit_id');
        $data=array('student_id'=>session('student_id'),'unit_id'=>$unit_id);
        DB::table('enrollments')->insert($data);
        return redirect('Stud_Classes_Select');
    }

    public function Unenroll(Request $request)
    {
        $unit_id = $request->input('unit_id');
        DB::table('enrollments')->where('id','=',$unit_id)->delete();
        return redirect('Stud_Classes_Select');
    }
}
