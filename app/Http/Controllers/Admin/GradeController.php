<?php

namespace App\Http\Controllers\Admin;

use App\Grade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Grade\StoreGradeRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = "Grade";
        $data['grades'] = Grade::with('student', 'teacher')->orderByDesc('updated_at')->paginate();

        return view('admin.grade.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = "New Grade";
        $data['students'] = User::where('role', User::ROLE_STUDENT)->orderBy('name')->get();
        $data['teachers'] = User::where('role', User::ROLE_TEACHER)->orderBy('name')->get();

        return view('admin.grade.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGradeRequest $request)
    {
        DB::beginTransaction();

        try {
            Grade::create($request->validated());
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return to_route('admin.grades.index')->with('error', $th->getMessage());
        }

        return to_route('admin.grades.index')->with('success', 'Grade created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        return $this->edit($grade);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        $data['title'] = "Edit Grade";
        $data['students'] = User::where('role', User::ROLE_STUDENT)->orderBy('name')->get();
        $data['teachers'] = User::where('role', User::ROLE_TEACHER)->orderBy('name')->get();
        $data['grade'] = $grade;

        return view('admin.grade.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreGradeRequest $request, Grade $grade)
    {
        DB::beginTransaction();

        try {
            $grade->update($request->validated());
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return to_route('admin.grades.index')->with('error', $th->getMessage());
        }

        return to_route('admin.grades.index')->with('success', 'Grade updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        DB::beginTransaction();

        try {
            $grade->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return to_route('admin.grades.index')->with('error', $th->getMessage());
        }

        return to_route('admin.grades.index')->with('success', 'Grade deleted');
    }
}
