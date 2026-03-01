@extends('layouts.app')

@section('content')
<h1>User List</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach($user->roles as $role)
                        <span class="badge bg-primary">{{ $role->name }}</span>
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Tasks</a>
@endsection