@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Top users tasks count</h1>
        <table class="table table-bordered mb-5">
            <thead>
            <tr class="table-success">
                <th scope="col">Name</th>
                <th scope="col">Tasks Count</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->tasks_count }}</td>
                </tr>
            @empty

                <p>There is no top users yet!</p>

            @endforelse
            </tbody>
        </table>

    </div>

@endsection
