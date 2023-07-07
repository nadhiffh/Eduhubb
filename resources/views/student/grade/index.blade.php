@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? config('app.name') }}</h1>

    <!-- Main Content goes here -->

    <table class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>Teacher</th>
                <th>Lesson</th>
                <th>Grade</th>
                <th>Note</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($grades as $grade)
                <tr>
                    <td>{{ $grade->teacher->full_name }}</td>
                    <td>{{ $grade->lesson_name }}</td>
                    <td>{{ $grade->grade }}</td>
                    <td>{!! nl2br($grade->note) !!}</td>
                    <td>{{ $grade->updated_at->format('d F Y, H:i') }}</td>
                </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center font-weight-bold text-muted">No class available</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $grades->links() }}

    <!-- End of Main Content -->
@endsection
