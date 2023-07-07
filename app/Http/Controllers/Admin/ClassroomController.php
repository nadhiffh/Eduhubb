<?php

namespace App\Http\Controllers\Admin;

use App\Classroom;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Classroom\StoreClassroomRequest;
use App\Http\Requests\Admin\Classroom\UpdateClassroomRequest;
use App\User;
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
        $data['classrooms'] = Classroom::paginate();

        return view('admin.classroom.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = "New Class";
        $data['semesters'] = Classroom::SEMESTERS;
        $data['teachers'] = User::where('role', User::ROLE_TEACHER)->orderBy('name')->get();

        return view('admin.classroom.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassroomRequest $request)
    {
        DB::beginTransaction();

        try {
            $request->merge([
                'note' => nl2br($request->note)
            ]);
            Classroom::create($request->validated());
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            
            return to_route('admin.class.index')->with('error', $th->getMessage());
        }

        return to_route('admin.class.index')->with('success', 'Classroom created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        return $this->edit($classroom);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        $data['title'] = "Edit Class";
        $data['semesters'] = Classroom::SEMESTERS;
        $data['teachers'] = User::where('role', User::ROLE_TEACHER)->orderBy('name')->get();
        $data['classroom'] = $classroom;

        return view('admin.classroom.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        DB::beginTransaction();

        try {
            $request->merge([
                'note' => nl2br($request->note)
            ]);
            $classroom->update($request->validated());
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return to_route('admin.class.index')->with('error', $th->getMessage());
        }

        return to_route('admin.class.index')->with('success', 'Classroom updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        DB::beginTransaction();

        try {
            $classroom->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return to_route('admin.class.index')->with('error', $th->getMessage());
        }

        return to_route('admin.class.index')->with('success', 'Classroom deleted');
    }
}
