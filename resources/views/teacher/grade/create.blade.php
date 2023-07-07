@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('teacher.grades.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="lesson_name">Lesson Name</label>
                    <input type="text" class="form-control @error('lesson_name') is-invalid @enderror" name="lesson_name"
                        id="lesson_name" autocomplete="off" value="{{ old('lesson_name') }}">
                    @error('lesson_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="student_id">Student</label>
                    <select class="form-control @error('student_id') is-invalid @enderror" name="student_id" id="student_id">
                        <option value="">Choose...</option>
                        @foreach ($students as $student)
                        <option value="{{ $student->getKey() }}" @selected(old('student_id') == $student->getKey())>{{ $student->full_name }}</option>
                        @endforeach
                    </select>
                    @error('student_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="grade">Grade</label>
                    <input type="number" class="form-control @error('grade') is-invalid @enderror" name="grade"
                        id="grade" autocomplete="off" value="{{ old('grade') }}">
                    @error('grade')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                  <label for="note">Note</label>
                  <textarea class="form-control" name="note" id="note" rows="3">{{ old('note') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('teacher.grades.index') }}" class="btn btn-default">Back to list</a>

            </form>
        </div>
    </div>

    <!-- End of Main Content -->
@endsection
