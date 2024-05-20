@extends('layouts.app')

@section('content')
    <h1>Todo List</h1>

    <a href="{{ route('task.create') }}" class="btn btn-primary mb-3">Create Task</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Completed</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($task as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ ucfirst($task->status) }}</td>
                    <td>
                        @if($task->complited)
                            <span class="badge bg-success">Yes</span>
                        @else
                            <span class="badge bg-danger">No</span>
                        @endif
                        <form action="{{ route('task.update', $task) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm">Complete</button>
                        </form>
                        
                    </td>
                    <td>
                        <a href="{{ route('task.edit', $task) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('task.destroy', $task) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection