@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? config('app.name') }}</h1>

    <!-- Main Content goes here -->

    <form class="form-inline mb-3" method="POST" action="{{ route('class.store') }}">
        @csrf
        <select class="custom-select my-1 mr-sm-2" name="academic_year" id="academic_year">
            @foreach ($academic_years as $academic_year)
                <option value="{{ $academic_year->academic_year }}" @selected(old('academic_year') == $academic_year->academic_year)>
                    {{ $academic_year->academic_year }}</option>
            @endforeach
        </select>

        <select class="custom-select my-1 mr-sm-2" name="semester" id="semester">
            @foreach ($semesters as $semester)
                <option value="{{ $semester }}" @selected(old('semester') == $semester)>{{ str($semester)->title }} Semester
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary my-1">Filter</button>
    </form>

    @forelse ($classrooms as $classroom)
        <div class="card mb-3">
            <div class="card-body">
                <a href="{{ route('class.show', $classroom->getKey()) }}">
                    <h4 class="card-title">{{ $classroom->name }}</h4>
                </a>
                <p class="card-text">Homeroom teacher: {{ $classroom->user->full_name }}</p>
                <p class="card-text">Class: {{ $classroom->code }}</p>
            </div>
        </div>
    @empty
        <div class="card mb-3">
            <div class="card-body">
                <h4 class="card-title text-center">No class available</h4>
            </div>
        </div>
    @endforelse

    {{ $classrooms->links() }}

    <!-- End of Main Content -->
@endsection
