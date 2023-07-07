<?php

namespace App\Http\Controllers;

use App\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = "Class";
        $data['academic_years'] = Classroom::query()
            ->select('academic_year')
            ->orderByDesc('academic_year')
            ->distinct()
            ->get();
        $data['semesters'] = Classroom::SEMESTERS;
        $data['classrooms'] = Classroom::latest()->paginate(5);

        return view('classroom.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'academic_year' => 'required|integer|digits:4',
            'semester' => 'required|string'
        ]);

        $data['title'] = 'Class - ' . $request->academic_year . ', ' . str($request->semester)->title . ' Semester';
        $data['academic_years'] = Classroom::query()
            ->select('academic_year')
            ->orderByDesc('academic_year')
            ->distinct()
            ->get();
        $data['semesters'] = Classroom::SEMESTERS;
        $data['classrooms'] = Classroom::query()
            ->where([
                'academic_year' => $request->academic_year,
                'semester' => $request->semester,
            ])
            ->latest()
            ->paginate(5);
        $data['request'] = $request->all();

        return view('classroom.index', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        $data['title'] = $classroom->name;
        $data['classroom'] = $classroom;

        return view('classroom.show', $data);
    }
}
