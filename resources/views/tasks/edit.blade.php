@extends('layouts.app')

@section('content')
<h1>Edit Task</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('tasks.update', $task) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input name="title" class="form-control"
                value="{{ old('title', $task->title) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" rows="5" class="form-control">{{ old('description', $task->description) }}</textarea>
    </div>

    <button class="btn btn-primary">Update</button>
</form>
@endsection