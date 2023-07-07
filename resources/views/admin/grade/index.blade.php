@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? config('app.name') }}</h1>

    <!-- Main Content goes here -->

    <a href="{{ route('admin.grades.create') }}" class="btn btn-primary mb-3">New Grade</a>

    <table class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>Teacher</th>
                <th>Lesson</th>
                <th>Student</th>
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
                    <td>{{ $grade->student->full_name }}</td>
                    <td>{{ $grade->grade }}</td>
                    <td>{{ str($grade->note)->limit(25, '(...)') }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('admin.grades.edit', $grade->getKey()) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                            <form action="{{ route('admin.grades.destroy', $grade->getKey()) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this?')">Delete</button>
                            </form>
                        </div>
                    </td>
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
