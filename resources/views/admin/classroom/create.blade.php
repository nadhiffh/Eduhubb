@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.class.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="name">Class Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        id="name" autocomplete="off" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="code">Class Code</label>
                    <input type="text" class="form-control @error('code') is-invalid @enderror" name="code"
                        id="code" autocomplete="off" value="{{ old('code') }}">
                    @error('code')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="academic_year">Academic Year</label>
                    <input type="text" class="form-control @error('academic_year') is-invalid @enderror"
                        name="academic_year" id="academic_year" autocomplete="off" value="{{ old('academic_year') }}">
                    @error('academic_year')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="semester">Semester</label>
                    <select class="form-control @error('semester') is-invalid @enderror" name="semester" id="semester">
                        <option value="">Choose...</option>
                        @foreach ($semesters as $semester)
                        <option value="{{ $semester }}" @selected(old('semester') == $semester)>{{ str($semester)->title }} Semester</option>
                        @endforeach
                    </select>
                    @error('semester')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="teacher_id">Teacher</label>
                    <select class="form-control @error('teacher_id') is-invalid @enderror" name="teacher_id" id="teacher_id">
                        <option value="">Choose...</option>
                        @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->getKey() }}" @selected(old('teacher_id') == $teacher->getKey())>{{ str($teacher->fullName)->title }}</option>
                        @endforeach
                    </select>
                    @error('teacher_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                  <label for="note">Note</label>
                  <textarea class="form-control" name="note" id="note" rows="3">{{ old('note') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('admin.class.index') }}" class="btn btn-default">Back to list</a>

            </form>
        </div>
    </div>

    <!-- End of Main Content -->
@endsection
