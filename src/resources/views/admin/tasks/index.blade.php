@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Tasks List</h1>
        <table class="table table-bordered mb-5">
            <thead>
            <tr class="table-success">
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Assigned Name</th>
                <th scope="col">Admin Name</th>
            </tr>
            </thead>
            <tbody>
            @forelse($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->userName }}</td>
                    <td>{{ $task->adminName }}</td>
                </tr>
            @empty

                <p>There is no tasks yet!</p>

            @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $tasks->links() !!}
        </div>
    </div>

@endsection
