@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a task for user</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('create_task') }}">
                            @csrf
                            <div class="form-group">
                                <label for="adminName">Admin Name</label>
                                <select class="form-control" id="adminName" name="assigned_by_id" >

                                    @foreach($admins as $admin)
                                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter the title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter the description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="assignedUser">Assigned User</label>
                                <select class="form-control" id="assignedUser" name="assigned_to_id">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary my-2">Create</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
