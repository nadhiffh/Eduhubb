@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? config('app.name') }}</h1>

    <!-- Main Content goes here -->

    <a href="{{ route('admin.class.create') }}" class="btn btn-primary mb-3">New Class</a>

    <table class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Class Name</th>
                <th>Code</th>
                <th>Academic Year</th>
                <th>Semester</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($classrooms as $classroom)
                <tr>
                    <td scope="row">{{ $classroom->getKey() }}</td>
                    <td>{{ $classroom->name }}</td>
                    <td>{{ $classroom->code }}</td>
                    <td>{{ $classroom->academic_year }}</td>
                    <td>{{ str($classroom->semester)->title }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('admin.grades.edit', $classroom->getKey()) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                            <form action="{{ route('admin.grades.destroy', $classroom->getKey()) }}" method="post">
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

    {{ $classrooms->links() }}

    <!-- End of Main Content -->
@endsection
