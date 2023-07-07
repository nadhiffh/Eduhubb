<?php

namespace App\Http\Controllers\Student;

use App\Grade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = "Grade";
        $data['grades'] = Grade::with('teacher')->where('student_id', Auth::id())->orderByDesc('updated_at')->paginate();

        return view('student.grade.index', $data);
    }
}
