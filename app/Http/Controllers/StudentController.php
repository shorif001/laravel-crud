<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('students.index',['students'=>$students]);
        // return view('students.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $student = new Student;
        $student->name = $request->name;
        $student->course = $request->course;

        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/student', $filename);
            $student->image = $filename;
        }else{
            dd('File not found');
        }

        $student->save();
        return redirect('/students')->with('status', 'Student added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        return view('students.edit', ['student'=>$student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        $student = Student::find($id);

        $student->name = $request->name;
        $student->course = $request->course;

        if($request->hasfile('image')){
            //old image ta delete korar jonno start
            $destinaton = 'uploads/student'.$student->image;
            if(File::exists($destinaton)){
                File::delete($destinaton);
            }
            //old image ta delete korar jonno end
            
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/student', $filename);
            $student->image = $filename;
        }else{
            dd('File not found');
        }

        $student->update();
        return redirect()->back()->with('status', 'student Updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
         
        $destinaton = 'uploads/student'.$student->image;
        if(File::exists($destinaton)){
            File::delete($destinaton);
        }
         
        $student->delete();
        return redirect()->back()->with('status', 'student Deleted succesfully');
    }
}
