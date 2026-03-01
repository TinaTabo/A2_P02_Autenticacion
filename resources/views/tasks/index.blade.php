@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Tasks</h1>

    {{-- Solo Admin y Editor pueden crear --}}
    @role('admin|editor')
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            Create Task
        </a>
    @endrole
</div>

@foreach($tasks as $task)
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title">{{ $task->title }}</h5>
            <p class="card-text">
                {{ \Illuminate\Support\Str::limit($task->description, 150) }}
            </p>

            {{-- Todos pueden ver --}}
            <a href="{{ route('tasks.show', $task) }}"
                class="btn btn-sm btn-outline-secondary">
                View
            </a>

            {{-- Solo Admin y Editor pueden editar/borrar --}}
            @role('admin|editor')
                <a href="{{ route('tasks.edit', $task) }}"
                    class="btn btn-sm btn-warning">
                    Edit
                </a>

                <form action="{{ route('tasks.destroy', $task) }}"
                        method="POST"
                        class="d-inline"
                        onsubmit="return confirm('Delete this task?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">
                        Delete
                    </button>
                </form>
            @endrole

        </div>
    </div>
@endforeach

{{ $tasks->links() }}

@endsection