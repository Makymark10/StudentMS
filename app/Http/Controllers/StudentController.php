<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::orderBy('created_at', 'desc')->get();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|max:255|unique:students,email',
            'age' => 'required|integer|min:5|max:120',
        ], [
            'name.required' => 'Please provide the student\'s full name.',
            'email.required' => 'An email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered to another student.',
            'age.required' => 'Please provide the student\'s age.',
            'age.integer' => 'Age must be a whole number.',
            'age.min' => 'Age must be at least 5 years old.',
            'age.max' => 'Age must be less than 120 years old.',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')
            ->with('success', 'Student registered successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return redirect()->route('students.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|max:255|unique:students,email,' . $student->id,
            'age' => 'required|integer|min:5|max:120',
        ], [
            'name.required' => 'Please provide the student\'s full name.',
            'email.required' => 'An email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered to another student.',
            'age.required' => 'Please provide the student\'s age.',
            'age.integer' => 'Age must be a whole number.',
            'age.min' => 'Age must be at least 5 years old.',
            'age.max' => 'Age must be less than 120 years old.',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')
            ->with('success', 'Student record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student record deleted successfully!');
    }
}
