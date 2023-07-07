@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? config('app.name') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-header">
            {{ $classroom->academic_year }}, {{ str($classroom->semester)->title }} Semester
        </div>
        <div class="card-body">
            <p class="card-text">Homeroom Teacher: {{ $classroom->user->full_name }}</p>
            <p class="card-text">{!! nl2br($classroom->note) !!}</p>
        </div>
        <div class="card-footer text-muted">
            Class: {{ $classroom->code }}
        </div>
    </div>

    <a href="{{ route('class.index') }}" class="btn btn-primary mt-3">Back to list</a>

    <!-- End of Main Content -->
@endsection
